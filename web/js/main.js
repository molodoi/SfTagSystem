
var tags = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    limit: 10,
    prefetch: {
        url: 'http://tagsystem.dev/app_dev.php/tags.json',
    }
});

tags.initialize();


$('.tag-input').tagsinput({
    typeaheadjs:[{
        highlights: true
    },{
        name: 'tags',
        display: 'title',
        value: 'title',
        source: tags
    }]
});


