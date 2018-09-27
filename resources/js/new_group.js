require('./bootstrap');
require('./selectize.min');

var settings = {
	"async": true,
	"crossDomain": true,
	"url": "http://api.local/api/users/all",
	"method": "GET",
	"headers": {
		"Accept": "application/json",
		"Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijk1M2FlNjcyMGQ0Yjc3NGU0N2JhZmZkOTNlYTU2YzE5YmM0MzhhODNjNzI0MTIyYmMxYzRkM2QwMjU0YTQzODIwNzM0ODczMTJlMTI2YzhmIn0.eyJhdWQiOiIyIiwianRpIjoiOTUzYWU2NzIwZDRiNzc0ZTQ3YmFmZmQ5M2VhNTZjMTliYzQzOGE4M2M3MjQxMjJiYzFjNGQzZDAyNTRhNDM4MjA3MzQ4NzMxMmUxMjZjOGYiLCJpYXQiOjE1MzgwNDU5NTksIm5iZiI6MTUzODA0NTk1OSwiZXhwIjoxNTY5NTgxOTU5LCJzdWIiOiIyIiwic2NvcGVzIjpbIioiXX0.X9NvPju-DXg3nPJUxbB2Yf6TQt0wDW_paj-_K4DyyAhlKSV4S4OptznE1eyUthUNjt0imT3Kzp_ZvVm7LfdBm17q0ddIfWB-QwTrn2QBVbbc82NWmPjGzohvoqoPf1SC9lMRoywyErAtG2JujuD2PqsZrwogjWz5NOCPxYgpLl5e3YY1szD4q153LGSwazYpkZMwfW4EIY2yBHdRCWMQXrqbCKG3Xltr63QC1fOuT-MjS6Ryr2JzrfrAg_o0t6rvuvjE3fJQf3O95wGV9MRzwP7KleXy1VAAiLcHHob_-f8yL-wRD2FVqnWmq6sacmKER10n7UZt0WjBBDwwhQQG_gIcg88fqub1FNcXhYABAwBUG6v6SFYB_fXoHnDszybgRK4SRzQ5W0U3QE_6V0xb0nxQL90hcsX8bJQyRnfYbTL0Rllcn1_W-YxfP9M_DeGUdHtXmIO7ANWt7R47S2cpe-M7apNW3Gxj_0S3U7AThHsbDWXE4DAhHPfhrKUo4dHqj1ZYsBmQSSXi86UISjRJajsifU_oi4rE86zjDfZnX09a37nAZ1NdiTlHAmgjkMR7xqPEd7a8-XbPyhkU45DpZ7jwXVsPN3w3Cku6fRPMVgwbTAmUkiTnVvIh3ofYpqr1A0d-yOJlwjpKVBPEnmJqy3NQAlbGpTRfwpT3qV81h2U"
	}
}

$.ajax( settings ).done( function( data ) {
	$('#usersInput').selectize({
	    persist: false,
	    maxItems: null,
	    valueField: 'id',
	    labelField: 'name',
	    searchField: ['name', 'email'],
	    options: data,
	    render: {
	        item: function(item, escape) {
	            return '<div>' +
	                (item.name ? '<span class="name">' + escape(item.name) + '</span>' : '') +
	            '</div>';
	        }
	    },
	    createFilter: function(input) {
	        var match, regex;

	        // email@address.com
	        regex = new RegExp('^' + REGEX_EMAIL + '$', 'i');
	        match = input.match(regex);
	        if (match) return !this.options.hasOwnProperty(match[0]);

	        // name <email@address.com>
	        regex = new RegExp('^([^<]*)\<' + REGEX_EMAIL + '\>$', 'i');
	        match = input.match(regex);
	        if (match) return !this.options.hasOwnProperty(match[2]);

	        return false;
	    },
	    create: function(input) {
	        if ((new RegExp('^' + REGEX_EMAIL + '$', 'i')).test(input)) {
	            return {email: input};
	        }
	        var match = input.match(new RegExp('^([^<]*)\<' + REGEX_EMAIL + '\>$', 'i'));
	        if (match) {
	            return {
	                email : match[2],
	                name  : $.trim(match[1])
	            };
	        }
	        alert('Invalid email address.');
	        return false;
	    }
	});
});

var REGEX_EMAIL = '([a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@' +
                  '(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)';

