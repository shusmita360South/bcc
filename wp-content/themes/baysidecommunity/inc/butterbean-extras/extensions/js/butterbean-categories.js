function acRemoveValue( list, value, separator ) {
    separator = separator || ',';
    var values = list.split( separator );

    for ( var i = 0 ; i < values.length; i++ ) {
        if ( values[ i ] == value ) {
            values.splice( i, 1 );
            return values.join( separator );
        }
    }

    return list;
}

( function() {

    butterbean.views.register_control( 'categories', {
        ready: function() {
            var $ = jQuery,
                _this = this,
                $categoriesInput = $( '.js-categories-input' ),
                $chosenList = $( '.js-categories-chosen' );

            $( '.js-categories-select' ).on( 'change', function( e ) {
                var idList = $categoriesInput.val(),
                    newIdList,
                    id = this.value,
                    text = $( this ).find( ':selected' ).text();

                if ( idList ) {
                    newIdList = idList + ',' + id;
                } else {
                    newIdList = id;
                }

                $categoriesInput.val( newIdList );

                // Remove the option
                $( this ).find( ':selected' ).remove();

                // Add to the chosen list:
                $chosenList.append( '<li data-id="' + id + '">' + text + '<span class="js-category-remove"><span class="dashicons dashicons-no-alt"></span></span></li>' );

                // Ensure the event works on the new node:
                this.removeCategoryEvent();
            });

            $( '.js-categories-chosen' ).on( 'click', function( e ) {
                var $el,
                    id,
                    text,
                    val = $categoriesInput.val(),
                    newValue;

                if ( ! $( e.target ).is( '.js-category-remove span' ) ) {
                    return;
                }

                $el = $( e.target ).parents( 'li' );
                id = $el.attr( 'data-id' );
                text = $el.text();

                // Remove the item from the chosen list:
                $chosenList.find( 'li[data-id=' + id + ']' ).remove();

                // Remove the id from the saved text input:
                newValue = acRemoveValue( val, id );
                $categoriesInput.val( newValue );

                // Add the item back into the select:
                $( '.js-categories-select' ).append( '<option value="' + id + '">' + text + '</option>' );
            });
        }
    } );

}() );
