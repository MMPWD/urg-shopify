Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

Vue.http.options.root = location.protocol + "//" + location.host;

var vehicleImagesPage = new Vue({

    el: '#vehicleImagesPage',

    data: {
        images: [],
        vehicleId: vehicleId,
        businessId: businessId,
    },

    created: function () {

    },

    computed: {
        vehicleImagePathJs: function () {
            return 'img/business/' + this.businessId + '/vehicles/' + this.vehicleId + '/images/';
        }
    },

    ready: function () {
        this.fetchVehicleImages();
    },

    filters: {},

    methods: {
        fetchVehicleImages: function () {
            var data = {'vehicleId': vehicleId};
            this.$http.get('ajax/vehicle/' + vehicleId + '/images/index', data, function (images) {
                this.$set('images', images);
            });
        },
        addImageToObject: function ($vehicleImage) {
            console.log(vehicleImage);
        },
        updateRank: function () {
            var images = {'images': this.images};
            this.$http.post('ajax/vehicle/' + vehicleId + '/images/updateRank', images).success(function (vehicleImages) {

                //this.addNewItem(data);

            }).error(function (vehicleImage) {
                alert('Sorry, There was an error updating the order, please refresh the page and try again.');
            });
        },
        rankChanged: function (oldPos, newPos) {

            var totalImageCount = this.images.length;
            var lowestImageChange = Math.min(oldPos, newPos);
            if (oldPos > newPos) {
                // Pushing indexes up
                var movementUp = false;
            } else {
                // Pushing Indexes down
                var movementUp = true;
            }

            var self = this;
            var i = 0;
            while (i < totalImageCount) {
                if (movementUp && self.images[i].rank >= lowestImageChange) {
                    //var currentItemRank = this.images[index].rank;
                    if (self.images[i].rank == oldPos + 1) {
                        self.images[i].rank = oldPos;
                    } else if (self.images[i].rank == oldPos) {
                        self.images[i].rank = newPos;
                    } else if (self.images[i].rank <= newPos) {
                        self.images[i].rank -= 1;
                    }

                } else if (!movementUp && self.images[i].rank <= oldPos) {
                    if (self.images[i].rank == oldPos - 1) {
                        self.images[i].rank = oldPos;
                    } else if (self.images[i].rank == oldPos) {
                        self.images[i].rank = newPos;
                    } else if (self.images[i].rank >= lowestImageChange) {
                        self.images[i].rank += 1;
                    }
                }
                i++
            }

            this.updateRank();
        },
        removeItem: function (image) {

            var totalImageCount = this.images.length;
            var rank = image.rank;
            this.removeAndReorder(image);

        },
        removeAndReorder: function (image) {

            // GET request
            var ImageRankToRemove = image.rank
            var self = this;

            this.$http.post('ajax/vehicle/' + vehicleId + '/images/' + image.id + '/remove').then(function (response) {

                var totalImageCount = self.images.length;

                var i = 0;
                while (i <= totalImageCount) {

                    if (self.images[i].rank == ImageRankToRemove) {
                        self.images.$remove(image);
                    }

                    if (self.images[i].rank > ImageRankToRemove) {
                        self.images[i].rank = self.images[i].rank - 1;
                    }

                    i++;
                }

                alert('all done');

            }, function (response) {

                alert('Sorry, there was an error removing the chosen image, please try again.');
            });

        }
    }
})