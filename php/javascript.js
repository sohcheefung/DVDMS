let id = $("input[name*='movie_id']")
id.attr("readonly","readonly");


$(".btnedit").click( e =>{
  let textvalues = displayData(e);

  let moviename = $("input[name*='movie_name']");
  let releaseyear = $("input[name*='release_year']");
  let moviegenre = $("input[name*='movie_genre']");
  let movieprice = $("input[name*='movie_price']");

  id.val(textvalues[0]);
  moviename.val(textvalues[1]);
  releaseyear.val(textvalues[2]);
  moviegenre.val(textvalues[3])
  movieprice.val(textvalues[4].replace("$",""));

});

function displayData(e){
  let id = 0;
  const td = $("#tbody tr td");
  let textvalues = [];

  for(const value of td){
    if(value.dataset.id == e.target.dataset.id){
      textvalues[id++] = value.textContent;
    }
  }
  return textvalues;
}

function displayHello(){
  const btn = document.getElementById('login');
  btn.addEventListener('click', function(){
    Swal.fire("Welcome")
  });
}
