var vueApp = new Vue({

    el: '#enquiriesPage',

    data: {
        items: [],
        listCountDefault: 25,
        listCount: 0,
        sortKey: 'created_at',
        sortReverse: -1,
        listSelection: 'unarchived',
        listFilter: '',
        loadingItems: false,
        itemCountShowing: 0,
        predefinedSearchLive: {
            property: '',
            value: '',
            operator: ''
        }
    },

    created: function () {

    },

    computed: {
        listSelectionIs: function (value) {
            return this.listSelection == value;
        }
    },

    ready: function () {
        this.fetchItems();
    },

    filters: {},

    methods: {
        sortBy: function (sortKey) {
            this.listCount = this.listCountDefault;
            if (this.sortKey == sortKey) {
                this.sortReverse = -this.sortReverse
            } else {
                this.sortReverse = 1;
            }
            this.sortKey = sortKey;
        },
        isSortedBy: function (sortKey) {
            if (this.sortKey == sortKey) {
                return true;
            }
        },
        isSortedReversed: function () {
            if (this.sortReverse == -1) {
                return true;
            }
            return false;
        },
        fetchItems: function () {
            this.loadingItems = true;
            this.$http.get('ajax/enquiry/index', function (items) {
                this.loadingItems = false;
                this.$set('items', items);
                this.increaseListCount(this.listCountDefault);
            });
        },
        selectListItem: function (item) {
            console.log(item.id);
            window.location = "/enquiries/" + item.id;
        },
        toggleRead: function (item,ev) {
            // Stop the row click happening
            ev.stopPropagation();

            //npw we need to call the ajax controller to toggle the enquiry read status
            this.$http.post('ajax/enquiry/' + item.id + '/toggleRead').success(function (blah) {
                // if the call succeeded then toggle the icon on screen
                var CL = ev.target.classList;
                CL.toggle("fa-envelope");
                CL.toggle("fa-envelope-unread");
                CL.toggle("fa-envelope-o");
                CL.toggle("fa-envelope-read");
            }).error(function (blah) {
                alert('Sorry, There was an error updating the enquiry, please refresh the page and try again.');
            });
        },           
        increaseListCount: function (number) {
            if (this.listCount <= this.itemCountShowing) {
                var prelimCount = this.listCount + number;
            }
            if (prelimCount >= this.items.length) {
                prelimCount = this.items.length
            }
            this.listCount = prelimCount;
        },
        setListSelection: function () {
            this.listCount = Math.min(this.listCountDefault, this.itemCountShowing);
        }
    }
})


Vue.filter('filterByListSelection', function (arr) {
    arr = convertArray(arr);
    if (this.listSelection == '') {
        return arr;
    }

    var res = [];

    for (var i = 0, l = arr.length; i < l; i++) {
        var item = arr[i];

        switch (this.listSelection) {
            case 'unarchived':
                if (item.archived == 0) {
                    res.push(item);
                }
                break;
            case 'new':
                if (item.opened == 0) {
                    res.push(item);
                }
                break;
            case 'archived':
                if (item.archived == 1) {
                    res.push(item);
                }
                break;
            default:
                res.push(item);
        }
    }
    return res;
});

Vue.filter('filterByCustom', function (arr, search, delimiter) {

    arr = convertArray(arr);

    if (search == null) {
        return arr;
    }
    if (typeof search === 'function') {
        return arr.filter(search);
    }
    // cast to lowercase string
    search = ('' + search).toLowerCase();
    // allow optional `in` delimiter
    // because why not
    var n = delimiter === 'in' ? 3 : 2;
    // extract and flatten keys
    var keys = toArray(arguments, n).reduce(function (prev, cur) {
        return prev.concat(cur);
    }, []);
    var res = [];
    var item, key, val, j;
    for (var i = 0, l = arr.length; i < l; i++) {
        item = arr[i];
        val = item && item.$value || item;
        j = keys.length;
        if (j) {
            while (j--) {
                key = keys[j];
                if (key === '$key' && contains(item.$key, search) || contains(getPath(val, key), search)) {
                    res.push(item);
                    break;
                }
            }
        } else if (contains(item, search)) {
            res.push(item);
        }
    }
    vueApp.itemCountShowing = res.length;
    return res;
});
