document.getElementById('submit-btn').addEventListener('click', function() {
    var name = document.getElementById('name').value;
    var place = document.getElementById('place').value;
    var rating = document.getElementById('rating').value;
    var review = document.getElementById('review').value;
  
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save_review.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById('message').innerText = "Ваш отзыв сохранен!";
      }
    };
    xhr.send("name=" + encodeURIComponent(name) + "&place=" + encodeURIComponent(place) + "&rating=" + encodeURIComponent(rating) + "&review=" + encodeURIComponent(review));
  });
  