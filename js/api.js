var xhr = require( 'xhr' );
var QueryString = require( 'query-string' );
var ROOT = 'https://www.johnsonbanks.co.uk/api';
// var ROOT = 'http://johnsonbanks-3-simonsweeney.c9users.io/api';

var cache = {};

module.exports = ( path, querystring, offset, limit ) => {
    
    var query = Object.assign( { offset, limit }, QueryString.parse( querystring ) );
    
    querystring = QueryString.stringify( query );
    
    var url = ROOT + path + '?' + querystring;
    
    return new Promise( resolve => {
        
        xhr({
            
            url,
            json: true
            
        }, ( error, response ) => {
            
            if ( !error ) resolve( response.body );
            
        })

        
    })
    
}