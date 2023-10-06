<script>
    jQuery(document).ready(function($) {
        const images = $('.wp-block-image').clone().toArray();
        var i = 0;
        const totalImages = images.length;
        const lastImage = totalImages - 1;

        //Initial
        $(function() {

            if (totalImages == 0) {

                $('.gallery').hide();
            } else {

                images.forEach((image, i) => {

                    $('.gallery-showcase').append('<div class="showcase-card card image-number-' + i + '"></div>');
                    $('.image-number-' + i).append(image);
                    i++;
                });

                $('.showcase-card').hide();

                $('.showcase-card').eq(i).show();
            }

            if (totalImages == 1) {
                $('.selector').css("visibility", "hidden");
            }

            if (totalImages > 1) {
                $('.rightArrow').css("visibility", "visible");
            }

            if (i == 0) {
                $('.leftArrow').css("visibility", "hidden");
            }
        });

        //Left Arrow
        $(function() {

            $('#leftArrow').on('click', () => {

                $('.showcase-card').eq(i).hide();
                i--;
                $('.showcase-card').eq(i).show();

                if (i == 0) {
                    $('.leftArrow').css("visibility", "hidden");
                }

                if (i => 0) {
                    $('.rightArrow').css("visibility", "visible");
                }
            })
        })

        //Right Arrow
        $(function() {

            $('#rightArrow').on('click', () => {

                if (i == lastImage) {
                    $('.rightArrow').css("visibility", "hidden");
                }

                $('.showcase-card').eq(i).hide();
                i++;
                $('.showcase-card').eq(i).show();

                if (i => 1) {
                    $('.leftArrow').css("visibility", "visible");
                }

                if (lastImage == i) {
                    $('.rightArrow').css("visibility", "hidden");
                }
            })
        })
    })
</script>

<div class="gallery">

    <button class="selector leftArrow" id="leftArrow">
        <h3 class="arrow">V</h3>
    </button>

    <div class="gallery-showcase"></div>

    <button class="selector rightArrow" id="rightArrow">
        <h3 class="arrow">V</h3>
    </button>
</div>