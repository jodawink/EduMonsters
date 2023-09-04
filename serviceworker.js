const cacheName = 'v1';
const preCacheName = 'install-time';
const cacheRuntime = 'run-time';
const constructedCacheName = `${cacheRuntime}-${cacheName} - ${location.origin}`;
const cacheFiles = {'script': true, 'image': true, 'font': true, 'style': true, 'document': true};

importScripts('./workbox-sw.js');
workbox.setConfig({ debug: false });
const {strategies} = workbox;
const {registerRoute} = workbox.routing;
const {CacheFirst} = workbox.strategies;
const {setCacheNameDetails} = workbox.core;

setCacheNameDetails({
    suffix: cacheName,
    precache: preCacheName,
    runtime: cacheRuntime
});

self.addEventListener('fetch', (event) => {
    if (cacheFiles[event.request.destination] || event.request.url.indexOf('.json?v=') !== -1 || event.request.url.indexOf('.txt?v=') !== -1) {        
        const cacheFirst = new strategies.CacheFirst();
        event.respondWith(cacheFirst.handle({request: event.request}));
    }
});

self.addEventListener('activate', e => {
    e.waitUntil(caches.keys().then(cacheNames => {
        return Promise.all(
                cacheNames.map(cache => {
                    if (cache !== constructedCacheName) {                        
                        return caches.delete(cache);
                    }
                }));
    }));
});

workbox.core.skipWaiting();
workbox.core.clientsClaim();