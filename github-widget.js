window.onload = () => {
    const el = (q) => {
        return document.querySelector(q);
    }

    const elAll = (q) => {
        return document.querySelectorAll(q);
    }

    const getParam = (name) => {
        var result = null,
        tmp = [];
        var items = location.search.substr(1).split("&");
        for (var index = 0; index < items.length; index++) {
            tmp = items[index].split("=");
            if (tmp[0] === name) result = decodeURIComponent(tmp[1]);
        }
        return result;
    }

    console.log(getParam('q'));
}