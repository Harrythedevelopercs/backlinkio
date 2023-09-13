<style>
    .button {
  display: inline-block;
  padding: 0.5em 1.0em;
  border-radius: 4px;
  background: #ffffff;
  font-family: sans-serif;
  font-size: 16px;
  cursor: pointer;
  border: 1px solid #000000;
  margin: 10px;
  -webkit-transition: background 0.3s;
  -moz-transition: background 0.3s;
  transition: background 0.3s;
}

.button:hover {
  background-color: rgba(0,0,0,0.1);
}

.button:active,
.button.is-checked {
  background-color: rgba(0,0,0,0.1);
  outline: none;
}

.button-group {
  margin: 20px 0;
  text-align: center;
}

.button-group:after {
  content: '';
  display: block;
  clear: both;
}

img {
  vertical-align: middle;
}

.img-responsive {
  display: block;
  max-width: 100%;
  height: auto;
}

.grid article {
  background-color: #FFFFFF;
  display: block;
  float: left;
  margin: 1%;
  width: 23%;
}

@media (max-width: 1024px) {
  .grid article {
    width: 31.3%;
  }
}

@media (max-width: 767px) {
  .grid article {
    width: 48%;
  }
}

@media (max-width: 479px) {
  .grid article {
    margin: 2% 0;
    width: 100%;
  }
}
.image-setting{
    height:400px;
    overflow-y:hidden;
    position: relative;
}
.img-hover-setting{

    transition: all 5s ease-in-out ;
    transform: translateY(0);
}

.img-hover-setting:hover{

    transform: translateY(calc(-100% + 400px));
}
</style>

<div class="button-group filters-button-group">
@foreach($images as $image)
        
        
    <button class="button" data-filter=".{{ $image['filter'] }}">{{ $image['title'] }}</button>
       
@endforeach
    
   
    
</div>

<section id="grid-container" class="transitions-enabled  js-masonry grid">
    

    @foreach($images as $index => $image)
        @for($i=0;$i < count($image['images']) ;$i++)
            <article class="{{ $image['filter'] }}">
                <div class="image-setting" >
                    <img src="{{ $image['images'][$i] }}" class="img-responsive" />
                </div>
            </article>
        @endfor
    @endforeach
    
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" ></script>
<script src="https://cdn2.hubspot.net/hub/322787/hub_generated/style_manager/1440007714979/custom/page/hack-a-thon-3/masonry.min.min.js" ></script>
<script src="https://cdn2.hubspot.net/hub/322787/hub_generated/style_manager/1440007849180/custom/page/hack-a-thon-3/isotope.min.js" ></script>

<script>
    $( function() {
  var $grid = $('.grid').isotope({
    itemSelector: 'article'
  });

  // filter buttons
  $('.filters-button-group').on( 'click', 'button', function() {
    var filterValue = $( this ).attr('data-filter');
    $grid.isotope({ filter: filterValue });
  });
  $('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
      $buttonGroup.find('.is-checked').removeClass('is-checked');
      $( this ).addClass('is-checked');
    });
  });
});

// debounce so filtering doesn't happen every millisecond
function debounce( fn, threshold ) {
  var timeout;
  return function debounced() {
    if ( timeout ) {
      clearTimeout( timeout );
    }
    function delayed() {
      fn();
      timeout = null;
    }
    timeout = setTimeout( delayed, threshold || 100 );
  }
}

$(window).bind("load", function() {
  $('#all').click();
});
</script>


