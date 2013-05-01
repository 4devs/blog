module.exports = function(grunt) {

    grunt.initConfig({

        concat: {
            main: {
                src: [
                    'dev/js/vendors/*.js',
                    'dev/js/main.js'
                ],
                dest: 'js/scripts.js'
            }
        },

        uglify: {
            main: {
                files: {
                    'js/scripts.min.js': '<%= concat.main.dest %>'
                }
            }
        },

        recess: {
            dist: {
                options: {
                    compile: true,
                    compress: true
                },
                files: {
                    'css/styles.css': [
                        'dev/less/standart.less',
                        'dev/bootstrap/docs/assets/css/bootstrap.css',
                        'dev/less/main.less'
                    ],
                    'css/responsive.css': [
                        'dev/bootstrap/docs/assets/css/bootstrap-responsive.css',
                        'dev/less/responsive/styles-gt980.less',
                        'dev/less/responsive/styles-gt1200.less',
                        'dev/less/responsive/styles-lt980.less',
                        'dev/less/responsive/styles-lt767.less',
                        'dev/less/responsive/styles-lt480.less',
                    ],
                    'css/print.css': [
                        'dev/less/print.less'
                    ]
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-recess');

    grunt.registerTask('default', ['concat', 'uglify', 'recess']);
};