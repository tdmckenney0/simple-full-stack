const CharactersView = Backbone.View.extend({
    el: '#characters',
    template: _.template($('#characters-template').html()),
    
    initialize: function () {
        this.render();
    },

    render: function () {
        this.$el.html(this.template({characters: this.collection.toJSON() }));
        return this.el;
    }
});

jQuery.ajax({
    url: 'http://localhost:8000/',
    type: "GET",
    xhrFields: {
        withCredentials: true
    }
}).done(function(data) {
    data = JSON.parse(data);
    var char = new CharactersView({
        collection: new Characters(data)
    });
});