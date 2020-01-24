$(document).ready(function(){
    ClassicEditor
        .create( document.querySelectorAll( '.editor' ) )
        .catch( error => {
            console.error( error );
    } );
});