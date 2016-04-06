$(function(){

    // jQuery methods go here...
    $('#isNotStudent').change(function() {
        if($(this).prop("checked")) {
            $('#studentId').val('');
            $('.nonStudent').show('slide',400);
            $('.student').hide('slide',400);
        } else {
            $('#user').val('');
            $('#userName').val('');
            $('.nonStudent').hide('slide',400);
            $('.student').show('slide',400);
        }
    });

    var purposeTitle = [];

    for (var i = 0; i < purposes.length; i++) {
        purposeTitle.push(purposes[i].purpose);
    }

    var purposeMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            matches = [];

            substringRegex = new RegExp(q, 'i');

            $.each(strs, function(i, str) {
                if (substringRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    };

    $('#purpose').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'purposeTitle',
        source: purposeMatcher(purposeTitle)
    });

    // $('#purpose').on('typeahead:selected', function(e, datum) {
    //     for (var i = 0; i < purposes.length; i++) {
    //         if(datum == purposes[i].purpose) {
    //             $('#purpose').val(purposes[i].id);
    //         }
    //         console.log($('#purpose').val());
    //     }
    // });
    
});

