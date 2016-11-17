var vueApp = new Vue({

    el: '#vehiclesPage',

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
        },
        businessId: businessId,
        magnifyBoxImage: null
    },

    created: function () {

    },

    computed: {
        listSelectionIs: function (value) {
            return this.listSelection == value;
        },
        vehicleImagePathJs: function () {
	        return 'img/business/' + this.businessId + '/vehicles/';
        }
    },

    ready: function () {
        this.fetchItems();
    },

    filters: {

    },

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
            this.$http.get('ajax/vehicle/index', function (items) {
                this.loadingItems = false;
                this.$set('items', items);
                this.increaseListCount(this.listCountDefault);
            });
        },
        selectListItem: function (item) {
            console.log(item.id);
            window.location = "/vehicles/" + item.id;
        },
        increaseListCount: function (number) {
            if (this.listCount <= this.itemCountShowing) {
                var prelimCount = this.listCount + number;
            }
            if (prelimCount > this.items.length) {
                prelimCount = this.items.length
            }
            this.listCount = prelimCount;
        },
        setListSelection: function () {
            this.listCount = Math.min(this.listCountDefault, this.itemCountShowing);
        },
        expandVehicleThumb: function (vehicle) {
            this.magnifyBoxImage = this.vehicleImagePathJs + vehicle.id + '/images/' + vehicle.primary_image.original_filename;
        },
        cancelVehicleThumb: function (vehicle) {
            this.magnifyBoxImage = null;
        }
    }
})


Vue.filter('filterByListSelection', function (arr) {

    arr = convertArray(arr);

    if (this.listSelection == '') {
        return arr;
    }

    var res = [];
	
	var vehicleStatus = {
		AwaitingPreparation: 1,
		InSoon: 2,
		OnSale: 3,
		OnSaleSpecialOffer: 4,
		Sold: 5,
		Wanted: 6,
		Reserved: 7,
	}
	
    for (var i = 0, l = arr.length; i < l; i++) {
        var item = arr[i];

        switch (this.listSelection) {
            case 'sold':
                if (item.status_id == vehicleStatus.Sold)
                    res.push(item);
                break;
            case 'live':
                if (item.status_id == vehicleStatus.OnSale || item.status_id == vehicleStatus.OnSaleSpecialOffer)
                    res.push(item);
                break;
			case 'featured':
                if (item.featured == 1)
                    res.push(item);
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