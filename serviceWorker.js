const staticCacheName = "cache-v1";
const assets = ["index.php"];

// ajout fichiers en cache
self.addEventListener("install", (e) => {
  e.waitUntil(
    caches.open(staticCacheName).then(cache => {
      cache.addAll(assets);
    })
  );
});

self.addEventListener("fetch", event => {
  event.respondWith(
    fetch(event.request).then(response => {

        caches.open(staticCacheName).then(cache=>  {
            cache.put(event.request, response);
          });


        return  response.clone();
      }).catch(error=>{
          return caches.match(event.request)
      })
  );
});

// // supprimer caches
// self.addEventListener("activate", (e) => {
//   e.waitUntil(
//     caches.keys().then((keys) => {
//     //   return Promise.add(
//     //     keys
//     //       .filter((key) => key !== staticCacheName)
//     //       .map((key) => caches.delete(key))
//     //   );
//     // })
// //   );
// });