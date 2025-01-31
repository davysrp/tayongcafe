
// Disable F12 and Ctrl key functions
document.onkeydown = function (e) {
  if (event.keyCode == 123 || (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) || (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) || (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0))) {
    return false;
  }
};

// Disable text selection
document.onselectstart = function (e) {
  e.preventDefault();
  return false;
};

// Disable right-click context menu
document.oncontextmenu = function (e) {
  e.preventDefault();
  return false;
};
// Block "view-source:" protocol and redirect to the desired URL
window.addEventListener('beforeunload', function (e) {
  var url = window.location.href.toLowerCase();
  if (url.startsWith('view-source:')) {
    e.preventDefault();
    window.location.href = 'https://www.mmotools.me/statistics';
  }
});


// Disable Ctrl key and F12 key
document.addEventListener("keydown", function (event) {
  if (event.ctrlKey || event.keyCode == 123) {
    event.preventDefault();
  }
});

if("serviceWorker" in navigator){
    navigator.serviceWorker.register("service_worker.js").then(registration=>{
      console.log("SW Registered!");
    }).catch(error=>{
      console.log("SW Registration Failed");
    });
}else{
  console.log("Not supported");
}
// Cached core static resources 
self.addEventListener("install",e=>{
  e.waitUntil(
    caches.open("static").then(cache=>{
      return cache.addAll(["./",'./images/logo192.png']);
    })
  );
});

// Fatch resources
self.addEventListener("fetch",e=>{
  e.respondWith(
    caches.match(e.request).then(response=>{
      return response||fetch(e.request);
    })
  );
});