(function () {
    /* Laravel Ajax Call for Bootsrap Modal */
    $(document).on('click', '.dynamic-modal', function () {
        console.log('saf');
        var $modal = $($this.data('target'));
        var action = $this.data('action') || $this.closest('form').attr('action');
        var modal_action = $modal.find('form').attr('action');
        if(! modal_action || modal_action != action) { $modal.find('form').attr('action',action); }
        if($this.data('target') && ! $modal.find('#dynamic-content').length) { return false; }
        /* Ajax Call Function */
        $.ajax({
            type: "GET",
            url: action,
            data: data,
            dataType: "html",
            success: function (data) {
                // console.log(data);
                $modal.find('#dynamic-content').removeClass('p-5').html(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $modal.find('#dynamic-content').addClass('p-5').html(errorThrown);
            }
        });
    });
});