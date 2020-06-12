# frozen_string_literal: true

require 'sassc'
require 'autoprefixer-rails'
require 'uglifier'
require 'oj'
require 'rubocop/rake_task'
require 'scss_lint/rake_task'
require 'logger'

$stdout.sync = $stderr.sync = true

# Logger
logger = Logger.new($stdout)
logger.datetime_format = '%F %T %:z'
logger.formatter = proc do |severity, datetime, _progname, msg|
  "#{datetime} | #{severity} | #{msg}\n"
end

# Tests
RuboCop::RakeTask.new
SCSSLint::RakeTask.new

# Helper
class Helper
  attr_reader :ext

  def initialize(logger)
    @logger = logger

    json = Oj.load_file('composer.json')
    @ext = json['name'].split('/')
  end

  def compile_scss(args = {})
    unless args.key?(:output)
      args[:output] = args[:input]
        .sub(%r{^scss/}, '')
        .sub(/\.scss$/, '.css')
    end

    @logger.info(format('Processing file: %<filename>s', filename: args[:input]))
    @logger.info(format('Style: %<style>s', style: args[:style].to_s))

    File.open(args[:output], 'w') do |f|
      css = SassC::Engine.new(
        File.read(args[:input]),
        style: args[:style],
        cache: false,
        syntax: :scss,
        filename: args[:input],
        sourcemap: :none
      ).render

      f.puts AutoprefixerRails.process(
        css,
        map: false,
        cascade: false,
        from: args[:input],
        to: args[:output],
        browsers: [
          '>= 1%',
          'last 1 major version',
          'not dead',
          'Chrome >= 45',
          'Firefox >= 38',
          'Edge >= 12',
          'Explorer >= 10',
          'iOS >= 9',
          'Safari >= 9',
          'Android >= 4.4',
          'Opera >= 30'
        ]
      ).css
    end

    @logger.info(format('Generated file: %<filename>s', filename: args[:output]))
  end

  def minify_file(args = {})
    args[:output] = minified_ext(args[:input]) unless args.key?(:output)
    args[:path] = asset_path(args[:input]) unless args.key?(:path)

    # Minify file
    @logger.info(format('Processing file: %<filename>s', filename: args[:output]))
    case args[:path]
    when 'css'
      File.open(args[:output], 'w') do |f|
        css = File.read(args[:input])

        f.puts SassC::Engine.new(
          css,
          style: :compressed,
          cache: false,
          syntax: :css,
          filename: args[:output],
          sourcemap: :none
        ).render
      end
    when 'js'
      File.open(args[:output], 'w') do |f|
        js = File.read(args[:input])

        f.puts Uglifier.compile(
          js,
          comments: :none,
          harmony: true
        )
      end
    else
      @logger.error(format('Invalid path: %<directory>s', directory: args[:path]))
      abort
    end
  end

  def replace_asset_file(files = [], html = '')
    files.each do |f|
      namespace = twig_namespace(f)
      next unless html.include?(namespace)

      # Generate minified file
      minify_file(input: f)

      # Replace filename in template
      html = html.gsub(namespace, minified_ext(namespace))
    end

    html
  end

  def base_dir
    File.join('build', 'package', @ext.first, @ext.last)
  end

  def twig_namespace(file_path)
    format(
      '@%<vendor>s_%<extname>s/%<path>s/%<filename>s',
      vendor: @ext.first,
      extname: @ext.last,
      path: asset_path(file_path),
      filename: File.basename(file_path)
    )
  end

  def asset_path(file_path)
    File.extname(file_path).gsub('.', '')
  end

  def minified_ext(file_path)
    ext = File.extname(file_path)

    return file_path if file_path.end_with?('.min' + ext)

    file_path.gsub(ext, '.min' + ext)
  end
end

namespace :build do
  files = {
    scss: Dir.glob('scss/styles/**/theme/css/*.scss'),
    css: Dir.glob('styles/**/theme/css/*.css') + Dir.glob('adm/style/css/*.css'),
    js: Dir.glob('styles/**/theme/js/*.js') + Dir.glob('adm/style/js/*.js')
  }

  # Exclude minified files
  files[:css].delete_if { |file| file.end_with?('.min.css') }
  files[:js].delete_if { |file| file.end_with?('.min.js') }

  helper = Helper.new(logger)

  desc 'Build CSS file'
  task :css do
    logger.info('Compiling CSS files')
    files[:scss].each do |file|
      helper.compile_scss(
        input: file,
        style: :expanded
      )
    end
  end

  desc 'Minify assets'
  task :minify do
    logger.info('Minifying assets')
    base_dir = helper.base_dir

    unless Dir.exist?(base_dir)
      logger.fatal(format('Directory not found: %<directory>s', directory: base_dir))
      abort
    end

    Dir.chdir(base_dir) do
      template = Dir.glob('styles/**/template/**/*.html') + Dir.glob('adm/style/**/*.html')

      template.each do |file|
        html = old_html = File.read(file)

        # Replace assets (CSS and JS)
        html = helper.replace_asset_file(files[:css], html)
        html = helper.replace_asset_file(files[:js], html)

        next if html.eql?(old_html)

        # Update template file
        logger.warn(format('Overwritting file: %<filename>s', filename: file))
        File.open(file, 'w') { |f| f.puts html }

        unless File.size(file).positive?
          logger.fatal(format('Generated empty file: %<filename>s', filename: file))
          abort
        end
      end
    end
  end

  desc 'Build assets'
  task :all do
    Rake::Task['build:css'].invoke
    Rake::Task['build:minify'].invoke
  end
end
