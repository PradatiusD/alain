
module.exports = function(grunt) {


  var assets = grunt.file.readJSON('bower.json');

  var sassFile = 'theme/style.sass';

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    watch: {
      options: {
        livereload: true
      },
      copy: {
        files: ['theme/*','!'+sassFile],
        tasks: ['copy']
      },
      sass: {
        files: [sassFile],
        tasks: ['sass']
      }
    },
    copy: {
      main: {
        src: '**',
        dest: '../themes/alain',
        cwd: 'theme/',
        expand: true
      },
      dep: {
        src: [assets.lib.php, assets.lib.img],
        dest: 'theme/lib/',
        flatten: true,
        expand: true,
      }
    },
    sass: {
      dist: {
        files: {
          'theme/style.css': sassFile
        }
      }
    },
    uglify: {
      homePgDep: {
        files: {
          'theme/lib/homepage-dependencies.min.js': [assets.lib.js]
        }
      }
    },
    'ftp-deploy': {
      build: {
        auth: {
          host: 'pradadesigners.com',
          port: 21,
          authKey: 'key'
        },
        src: 'theme',
        dest: 'alain',
        exclusions: ['theme/lib']
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-ftp-deploy');
  grunt.registerTask('default', ['watch']);
  grunt.registerTask('deploy', ['ftp-deploy']);
};