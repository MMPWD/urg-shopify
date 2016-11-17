var vueApp = new Vue({

    el: '#postsPage',

     data: {
        items: [],
        listCountDefault: 25,
        listCount: 0,
        sortKey: 'name',
        sortReverse: 1,
        listSelection: '',
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
            this.$http.get('ajax/post/index', function (items) {
                this.loadingItems = false;
                this.$set('items', items);
                this.increaseListCount(this.listCountDefault);
            });
        },
        selectListItem: function (item) {
            console.log(item.id);
            window.location = "/posts/" + item.id + "/edit";
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
            case 'drafts':
                if (item.published_on == null) {
                    res.push(item);
                }
                break;
            case 'published':
                if (item.published_on != null) {
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
