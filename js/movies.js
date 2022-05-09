//shows the information
$('.card-img-top').click(function () {
  $(this).next().toggleClass('hidden')
})

//only show 1 movie information, it closes all other cards
$('.card-img-top').click(function () {
  $('.card-img-top').not(this).next().addClass('hidden')
})

//shows the movie
$('.movie').click(function () {
  $('.video').toggleClass('hidden')
})
//hides the movie
$('.movie').click(function () {
  $('.movie').not(this).next().addClass('hidden')
})
