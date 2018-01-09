const upvotes = document.querySelectorAll('.upvote');
const downvotes = document.querySelectorAll('.downvote');
const voteSums = document.querySelector('.voteSums');
const url = "../../voteSys.php";
const voteTot = "../../voteGet.php";

Array.from(upvotes).forEach(upvote => {
  upvote.addEventListener('click', () => {
    fetch(url, {
      method: "POST",
      headers: {"Content-Type": "application/x-www-form-urlencoded"},
      credentials: "include",
      body: `upvote=${upvote.value}&rating=${upvote.dataset.rating}`
    })
  })
});

Array.from(upvotes).forEach(upvote => {
  upvote.addEventListener('click', () => {
    fetch(voteTot, {
      method: "POST",
      headers: {"Content-Type": "application/x-www-form-urlencoded"},
      credentials: "include",
      body: `post_id=${upvote.value}`
    })
    .then(response =>{
      return response.json()
    })
    .then(voteSum =>{
      const postSum = upvote.parentElement.querySelector('.voteSums');
      postSum.textContent = `${voteSum.voteTot}`;
      console.log(voteSum.voteTot);
    })
  })
});

Array.from(downvotes).forEach(downvote => {
  downvote.addEventListener('click', () => {
    fetch(url, {
      method: "POST",
      headers: {"Content-Type": "application/x-www-form-urlencoded"},
      credentials: "include",
      body: `downvote=${downvote.value}&rating=${downvote.dataset.rating}`
    })
  })
});

Array.from(downvotes).forEach(downvote => {
  downvote.addEventListener('click', () => {
    fetch(voteTot, {
      method: "POST",
      headers: {"Content-Type": "application/x-www-form-urlencoded"},
      credentials: "include",
      body: `post_id=${downvote.value}`
    })
    .then(response =>{
      return response.json()
    })
    .then(voteSum =>{
      const postSum = downvote.parentElement.querySelector('.voteSums');
      postSum.textContent = `${voteSum.voteTot}`;
      console.log(voteSum.voteTot);
    })
  })
});
