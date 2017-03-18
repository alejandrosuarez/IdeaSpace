AFRAME.registerComponent('isvr-hotspot-text-listener', {
  
    init: function () {

        this.el.addEventListener('click', function(e) {

            if (this.getAttribute('data-content-id') == document.querySelector('#photosphere').getAttribute('data-content-id') && 
                document.querySelector('#photosphere-menu').getAttribute('visible') == false) {        

                e.target.setAttribute('visible', false);

                var content_id = document.querySelector('#photosphere').getAttribute('data-content-id');
                var hotspots = document.querySelectorAll('.hotspot-wrapper-content-id-' + content_id);
                for (var i = 0; i < hotspots.length; i++) {
                    hotspots[i].setAttribute('visible', true);
                }                 

            }

        });

    }
});

