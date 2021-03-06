'use strict'

const upvotes = document.querySelectorAll('.upvote');
const downvotes = document.querySelectorAll('.downvote');
const voteSums = document.querySelector('.voteSums');
const url = "../../voteSys.php";
const voteTot = "../../voteGet.php";
const voteDir = "../../dirGet.php";

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
    setTimeout (function (){
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
    })
  },10);
  setTimeout (function (){
  fetch(voteDir, {
    method: "POST",
    headers: {"Content-Type": "application/x-www-form-urlencoded"},
    credentials: "include",
    body: `post_id=${upvote.value}`
  })
  .then(response =>{
    return response.json()
  })
  .then(voteDirr =>{
    const postSum = upvote.parentElement.querySelector('.voteSums');
    if (voteDirr.vote_dir == 1) {
      postSum.style.color = "#EB3324";
    } else  {
      postSum.style.color = "#000000";
    }
  })
},10);
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
        setTimeout (function (){
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
    })
  },10);
  setTimeout (function (){
  fetch(voteDir, {
    method: "POST",
    headers: {"Content-Type": "application/x-www-form-urlencoded"},
    credentials: "include",
    body: `post_id=${downvote.value}`
  })
  .then(response =>{
    return response.json()
  })
  .then(voteDirr =>{
    const postSum = downvote.parentElement.querySelector('.voteSums');
    if (voteDirr.vote_dir == -1) {
      postSum.style.color = "#001FF5";
    } else {
      postSum.style.color = "#000000";
    }
  })
},10);
})
});
