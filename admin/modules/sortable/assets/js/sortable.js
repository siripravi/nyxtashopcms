function initSortable() {
    var position = [];
    $('[data-sortable=1] tbody').sortable({
        animation: 300,
        handle: '.sortable-handler',
        dataIdAttr: 'data-key',
        onChoose: function (evt) {
            position = [];
            $(this.el).find('*[' + this.options.dataIdAttr + ']').each(function(){
                position.push($(this).attr('data-position'));
            });
        },
        onEnd: function(evt) {
            $(this.el).find('*[' + this.options.dataIdAttr + ']').each(function(){
                $(this).attr('data-position', position[$(this).index()]);
            });
            $.post($(this.el).parents('[data-sortable=1]').data('sortable-url'), {
                ids: this.toArray(),
                position: position
            });
        }
    });
}
