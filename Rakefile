# frozen_string_literal: true

require 'sassc'
require 'autoprefixer-rails'
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

namespace :build do
  files = Dir.glob('scss/styles/**/theme/css/*.scss')

  desc 'Build setup'
  task :setup do
    Dir.mkdir('build') unless Dir.exist?('build')
  end

  # Base build
  task :base, [:opts] => [:setup] do |_t, args|
    unless args[:opts].key?(:output)
      args[:opts][:output] = args[:opts][:input]
        .sub(%r{^scss/}, '')
        .sub(/\.scss$/, '.css')
    end

    if args[:opts][:style] == :compressed &&
        !args[:opts][:output].match?(/\.min\.css$/)
      args[:opts][:output] = args[:opts][:output]
        .sub(/\.css$/, '.min.css')
    end

    logger.info(format('Processing file: %<filename>s', filename: args[:opts][:input]))
    logger.info(format('Style: %<style>s', style: args[:opts][:style].to_s))

    File.open(args[:opts][:output], 'w') do |f|
      css = SassC::Engine.new(
        File.read(args[:opts][:input]),
        style: args[:opts][:style],
        cache: false,
        syntax: :scss,
        filename: args[:opts][:input],
        sourcemap: :none
      ).render

      f.puts AutoprefixerRails.process(
        css,
        map: false,
        cascade: false,
        from: args[:opts][:input],
        to: args[:opts][:output],
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

    logger.info(format('Generated file: %<filename>s', filename: args[:opts][:output]))
  end

  desc 'Build CSS file'
  task :css do
    files.each do |file|
      Rake::Task['build:base'].reenable
      Rake::Task['build:base'].invoke(
        input: file,
        style: :expanded
      )
    end
  end

  desc 'Build minified CSS file'
  task :minified do
    files.each do |file|
      Rake::Task['build:base'].reenable
      Rake::Task['build:base'].invoke(
        input: file,
        style: :compressed
      )
    end
  end

  desc 'Build all CSS files'
  task :all do
    Rake::Task['build:css'].invoke
    # Rake::Task['build:minified'].invoke
  end
end
