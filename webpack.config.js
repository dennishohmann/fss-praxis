var Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');
Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    //Final File and listen on
    //
    .createSharedEntry('js/layout', './assets/js/layout.js')
    .addEntry('js/rep_log', './assets/js/rep_log.js')
    .addEntry('js/login', './assets/js/login.js')
    .addEntry('js/article_show', './assets/js/article_show.js')

    //.addStyleEntry('css/app', './assets/css/app.scss')

    // uncomment if you use Sass/SCSS files
    .enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
    .autoProvidejQuery()
    .enableReactPreset()

    .cleanupOutputBeforeBuild()
    .enableVersioning()

    .addPlugin(new CopyWebpackPlugin([
        // copies to {output}/static
        { from: './assets/static', to: 'static' }
    ]))
    .enableSourceMaps(!Encore.isProduction())
    //.enableBuildNotifications()
;
    // fetch the config, then modify it!
    // var config = Encore.getWebpackConfig();
    // config.watchOptions = { poll: true };

    // other examples: add an alias or extension
    // config.resolve.alias.local = path.resolve(__dirname, './resources/src');
    // config.resolve.extensions.push('json');

    // export the final config
    // module.exports = config;


module.exports = Encore.getWebpackConfig();


// command
//  yarn watch