module.exports = function(grunt) {

	// 1. Toutes les configurations vont ici: 
	grunt.initConfig({
	    pkg: grunt.file.readJSON('package.json'),

		sass: {
	        dist: {
	            options: {
	                style: 'compressed'
	            },
	            files: {
	                'css/style.css': 'css/style.scss'
	            }
	        } 
	    },

	    watch: {
	        css: {
	            files: ['css/*.scss'],
	            tasks: ['sass'],
	            options: {
	                spawn: false
	            }
	        } 
	    }		

	});

	// 3. Nous disons à Grunt que nous voulons utiliser ce plug-in.
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-sass');

	// 4. Nous disons à Grunt quoi faire lorsque nous tapons "grunt" dans la console.
	grunt.registerTask('default', ['watch', 'sass']);

};