require('es6-shim');
require('./lib/detectIE');
require('./lib/detectTouch');

var page = require('page');

var api = require('./api');
var state = require('./state');

var Nav = require('./components/Nav');
var Feed = require('./components/Feed');
var Grid = require('./components/Grid');

state.registerComponent( Nav );
state.registerComponent( Feed );
state.registerComponent( Grid );

// var views = require( './views/*.js', { mode: 'hash', resolve: ['path-reduce', 'strip-ext'] } );

var home = require('./views/home');
var work = require('./views/work');
var project = require('./views/project');
var thoughts = require('./views/thoughts');
var news = require('./views/news');
var about = require('./views/about');
var search = require('./views/search');

var Static = require('./views/Static');

var redirectToFirstSlug = path => {
    
    return ( ctx, next ) => {
        
        return api( path, ctx.querystring, 0, 1 )
            .then( response => {
                
                var slug = response.articles[ 0 ].slug;
                
                var url = ctx.pathname + '/' + slug;
                
                if ( ctx.querystring ) url += '?' + ctx.querystring;
                
                page.redirect( url );
                
            })
        
    }
    
}

page( '/', home );

page( '/work', work );
page( '/work/:slug', project );

page( '/thoughts', redirectToFirstSlug( '/thoughts' ) );
page( '/thoughts/:slug', thoughts );

page( '/news', redirectToFirstSlug( '/news' ) );
page( '/news/:slug', news );

page( '/about', redirectToFirstSlug( '/about' ) );
page( '/about/:slug', about );

page( '/contact', Static('Contact') );
page( '/sign-up', Static('Sign Up') );
page( '/cookie-policy', Static('Cookie Policy') );

page( '/search/:query', search );

page( '*', '/' );

page();