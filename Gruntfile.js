
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
        src: assets.lib.php,
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
    }
  });

  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.registerTask('default', ['watch']);
};