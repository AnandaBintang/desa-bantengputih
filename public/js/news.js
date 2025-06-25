// News functionality
function toggleLike(newsId) {
    // Implement like functionality
    console.log('Like news:', newsId);
}

function shareNews(url, title) {
    if (navigator.share) {
        navigator.share({
            title: title,
            url: url
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(url).then(() => {
            alert('Link berhasil disalin!');
        });
    }
}
