module.exports = function (grunt) {
  'use strict';

  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-autoprefixer');

  var configBridge = grunt.file.readJSON('./grunt/configBridge.json', { encoding: 'utf8' });

  // to do
  var globalConfig = {
    public_html: '../../../',
    assets: 'assets',
    source: 'source',
    stylesheet: 'bayside',
    javascript: 'app',
  };


  // Project configuration.
  grunt.initConfig({
    // Config Variable
    globalConfig: globalConfig,




    wordpress_root_dir : 'C:/wamp64/www/360South/dev.bcc.local/',
    wordpress_theme_name : 'baysidecommunity',
    build_www_dir : '<%= wordpress_root_dir %>/wp-content/themes/<%= wordpress_theme_name %>/',

    



    sass: {
      dist: {
        files: {
          '<%= globalConfig.assets %>/css/<%= globalConfig.stylesheet %>.css': '<%= globalConfig.source %>/scss/<%= globalConfig.stylesheet %>.scss'
        }
      }
    },

    copy: {
      local_development: {
        files: [
          {
            cwd: '',
            expand: true, 
            src: [ 
              '**',
              '!node_modules/**',
              '!.sass-cache/**',
              '!grunt/**',
              '!source/**',
            ],
            dest: '<%= build_www_dir %>'
          },
        ]
      },
    },


    autoprefixer: {
      options: {
        browsers: configBridge.config.autoprefixerBrowsers
      },
      development: {
        options: {
          map: true
        },
        src: '<%= globalConfig.assets %>/css/*.css'
      },
    },
    cssmin: {
      options: {
        compatibility: 'ie11',
        keepSpecialComments: '*',
        sourceMap: false,
        advanced: false
      },
     
      cssvendor: {
        src: '<%= globalConfig.assets %>/css/vendor.css',
        dest: '<%= globalConfig.assets %>/css/vendor.min.css'
      },
      cssstyle: {
        src: '<%= globalConfig.assets %>/css/bayside.css',
        dest: '<%= globalConfig.assets %>/css/bayside.min.css'
      },
    },
    concat: {
      cssvendor: {
        src: [
          '<%= globalConfig.source %>/scss/vendor/*.css'
        ],
        dest: '<%= globalConfig.assets %>/css/vendor.css'
      },
      jsvendor: {
        src: [
          '<%= globalConfig.source %>/js/vendor/*.js'
        ],
        dest: '<%= globalConfig.assets %>/js/vendor.js'
      },
      app: {
        src: [
          '<%= globalConfig.source %>/js/<%= globalConfig.javascript %>.js'
        ],
        dest: '<%= globalConfig.assets %>/js/<%= globalConfig.javascript %>.js'
      }
    },
    uglify: {
      options: {
        compress: {
          warnings: false
        },
        mangle: true,
        preserveComments: false
      },
      vendor: {
        src: '<%= concat.jsvendor.dest %>',
        dest: '<%= globalConfig.assets %>/js/vendor.min.js'
      },
      app: {
        src: '<%= globalConfig.assets %>/js/<%= globalConfig.javascript %>.js',
        dest: '<%= globalConfig.assets %>/js/<%= globalConfig.javascript %>.min.js'
      },
    },
    watch: {
      css: {
        files: ['<%= globalConfig.source %>/scss/*.scss', '<%= globalConfig.source %>/scss/*/*.scss'],
        tasks: ['css']
      },
      javascript: {
        files: ['<%= globalConfig.source %>/js/vendor/*.js', '<%= globalConfig.source %>/js/<%= globalConfig.javascript %>.js'],
        tasks: ['js']
      },


      local_development: {
        files: [
          '<%= globalConfig.source %>/scss/**', 
          '<%= globalConfig.source %>/js/**',
          '<%= globalConfig.source %>/**/*.php',
          '<%= globalConfig.source %>/*.css'
        ],
        tasks: ['js', 'css', 'copy:local_development']
      },
    },
  });

  grunt.registerTask('js',  ['concat', 'uglify']);
  grunt.registerTask('css', ['sass', 'concat', 'autoprefixer', 'cssmin']);

  grunt.registerTask('css', ['sass', 'concat', 'autoprefixer', 'cssmin']);

  grunt.registerTask('default', ['js', 'css']);

  grunt.registerTask('local-development', ['js', 'css', 'copy:local_development', 'watch:local_development']);

};