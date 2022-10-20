 <!-- CATEGORIES SECTION-->
 <section class="pt-5">
     <header class="text-center">
         <p class="small text-muted small text-uppercase mb-1">Carefully created collections</p>
         <h2 class="h5 text-uppercase mb-4">Browse our categories</h2>
     </header>
     <div class="row">
         @if ($top4Categories->count() > 0)
             <div class="col-md-4 mb-4 mb-md-0">
                 <a class="category-item vert" href="shop.html">
                     <img class="img-fluid" src="{{ asset('storage/' . $top4Categories[0]->cover) }}" alt="">
                     <strong class="category-item-title">
                         {{ $top4Categories[0]->name }}
                     </strong>
                 </a>
             </div>
             <div class="col-md-4 mb-4 mb-md-0">
                 <a class="category-item mb-4 horizantal" href="shop.html">
                     <img class="img-fluid" src="{{ asset('storage/' . $top4Categories[1]->cover) }}" alt="">
                     <strong class="category-item-title">
                         {{ $top4Categories[1]->name }}
                     </strong>
                 </a>
                 <a class="category-item horizantal" href="shop.html">
                     <img class="img-fluid" src="{{ asset('storage/' . $top4Categories[2]->cover) }}" alt="">
                     <strong class="category-item-title">
                         {{ $top4Categories[2]->name }}
                     </strong>
                 </a>
             </div>
             <div class="col-md-4">
                 <a class="category-item vert" href="shop.html">
                     <img class="img-fluid" src="{{ asset('storage/' . $top4Categories[3]->cover) }}" alt="">
                     <strong class="category-item-title">
                         {{ $top4Categories[3]->name }}
                     </strong>
                 </a>
             </div>
         @endif
     </div>
 </section>
