/**
 * Utility function to help submit forms/ form controls via AJAX.
 * @param selector: Optional. Parameter passed to find() to restrict which elements are serialized. Default is to return all elements
 * @param success: Required. A function to be executed when the AJAX request completes. Arguments are standard AJAX args. 'this' is the form.
 * @param error: Required. A function to be executed when the AJAX request fails. Arguments are standard AJAX args. 'this' is the form.
 */
jQuery.fn.ajaxify = function (selector, success, error) {
    // Handle the optional case of selector.
    if (arguments.length === 2) {
        error = success;
        success = selector;
        selector = undefined;
    }

    return this.on('submit', function (e) {
        // Copy the options from the '<form />' control.
        jQuery.ajax({
            url: this.action,
            method: this.method || 'POST',
            data: (typeof selector === 'undefined' ? $(this).serialize() : $(this).find(selector).serialize())
        }).done(jQuery.proxy(success, this)).fail(jQuery.proxy(error, this));

        e.preventDefault(); // Don't forget to stop the form from being submitted the "normal" way.
    });
};