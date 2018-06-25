const Characters = Backbone.Collection.extend({
    model: Character,
    url: 'http://localhost:8000/',
    initialize: function () {
        this.fetch();
    }
});