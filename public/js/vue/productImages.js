Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

Vue.http.options.root = location.protocol + "//" + location.host;

var productImagesPage = new Vue({

    el: '#productImagesPage',

    data: {
        images: [],
        productId: productId,
    },

    created: function () {

    },

    computed: {
        vehicleImagePathJs: function () {
            return 'img/product/' + this.productId + '/images/';
        }
    },

    ready: function () {
        this.fetchVehicleImages();
    },

    filters: {},

    methods: {
        fetchVehicleImages: function () {
            var data = {'productId': productId};
            this.$http.get('ajax/product/' + productId + '/images/index', data, function (images) {
				//04 Jun 2016 - DA - Rank needs to be an integer and not a string for comparisson/sorting to work correctly
                console.log('i='+images);
				// $.each(images, function(k, v) {
				// 	v.rank = parseInt(v.rank);
				// });
              //this.$set('images', images);
              document.getElementById("prodImg").src= images;
            });
        },
        updateRank: function () {
            var images = {'images': this.images};
            this.$http.post('ajax/product/' + productId + '/images/updateRank', images).success(function (productImages) {

                //this.addNewItem(data);

            }).error(function (productImage) {
                alert('Sorry, There was an error updating the order, please refresh the page and try again.');
            });
        },
        rankChanged: function (oldPos, newPos) {

			if (newPos == undefined) //the image was dragged and dropped onto itself
				return;
		
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
			            
			if (confirm("You are about to delete this image.\n\nAre you sure?\n\nClick 'OK' to continue.\nClick 'Cancel' to cancel."))
				this.removeAndReorder(image);

        },
        removeAndReorder: function (image) {

            // GET request
            var ImageRankToRemove = image.rank;
            var self = this;

            this.$http.post('ajax/product/' + productId + '/images/' + image.id + '/remove').then(function (response) {

                var totalImageCount = self.images.length;

				//04 Jun 2016 - DA - Since we are removing an item from the collection we
				//should walk through the collection backwards so that removing the item
				//is that last operation performed on the collection
                var i = totalImageCount - 1;
                while (i >= 0)
				{
                    if (self.images[i].rank == ImageRankToRemove)
                        self.images.$remove(image);                    
					else if (self.images[i].rank > ImageRankToRemove)
                        self.images[i].rank = self.images[i].rank - 1;
                    i--;
                }

                // alert('All done');
				
            }, function (response) {

                alert('Sorry, there was an error removing the chosen image, please try again.');
            });

        }
    }
})