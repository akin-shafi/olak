const staticCacheName = 'precache-v2.0';
const dynamicCacheName = 'runtimeCache-v2.0';

// Pre Caching Assets
const precacheAssets = [
    '/',
    'assets/dist/css/bootstrap.css',
    'assets/dist/css/styles.css',
    'pwa.js',
    'manifest.json',
    'login.php',
    'index.php'
    
];

// Install Event
self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open(staticCacheName).then(function (cache) {
            return cache.addAll(precacheAssets);
        })
    );
});

// Activate Event
self.addEventListener('activate', function (event) {
    event.waitUntil(
        caches.keys().then(keys => {
            return Promise.all(keys
                .filter(key => key !== staticCacheName && key !== dynamicCacheName)
                .map(key => caches.delete(key))
            );
        })
    );
});

// Fetch Event
// self.addEventListener('fetch', function (event) {
//     event.respondWith(
//         caches.match(event.request).then(cacheRes => {
//             return cacheRes || fetch(event.request).then(response => {
//                 return caches.open(dynamicCacheName).then(function (cache) {
//                     cache.put(event.request, response.clone());
//                     return response;
//                 })
//             });
//         }).catch(function() {
//             // Fallback Page, When No Internet Connection
//             return caches.match('page-fallback.html');
//           })
//     );
// });


self.addEventListener("fetch", e =>{
        console.log(e.request.url);
        e.respondWith(
            caches.match(e.request).then(response =>{
                return response || fetch(e.request);
            }).catch(function() {
            // Fallback Page, When No Internet Connection
            return caches.match('index.php');
          })
        );
    });

