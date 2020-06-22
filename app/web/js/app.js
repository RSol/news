window.onload = function () {
    const newsListTemplate = document.getElementById('newsListTemplate').innerHTML;
    const sortTemplate = document.getElementById('sortTemplate').innerHTML;
    const pagerTemplate = document.getElementById('pagerTemplate').innerHTML;
    const oneNewsTemplate = document.getElementById('oneNewsTemplate').innerHTML;
    const viewBlock = document.getElementById('target');

    const news = {
        sort: '',
        sortDirection: '',
        page: 1,
        getNewsListUrl() {
            let url = '/api/news?';
            if (this.page !== 1) {
                url += `page=${this.page}&`;
            }
            if (this.sort) {
                url += `sort=${this.sort}.${this.sortDirection}`;
            }
            return url;
        },
        newsList(url) {
            fetch(url || this.getNewsListUrl())
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    viewBlock.innerHTML = Mustache.render(sortTemplate, [])
                        + Mustache.render(pagerTemplate, data.meta)
                        + Mustache.render(newsListTemplate, data)
                        + Mustache.render(pagerTemplate, data.meta);
                    this.addOneNewsClick();
                    this.addSortClick();
                    this.addPageClick();
                });
        },
        addOneNewsClick() {
            this.addClickListener('showOne', this.oneNewsClick);
        },
        removeOneNewsClick() {
            this.removeClickListener('showOne', this.oneNewsClick);
        },
        oneNewsClick(event) {
            event.preventDefault();
            this.removeOneNewsClick();
            fetch('/api/news/' + event.target.rel)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    viewBlock.innerHTML = Mustache.render(oneNewsTemplate, data);
                    this.addBackLinkClick();
                });
        },

        addSortClick() {
            this.addClickListener(' sortLink', this.sortClick);
        },
        removeSortClick() {
            this.removeClickListener(' sortLink', this.sortClick);
        },
        sortClick(event) {
            event.preventDefault();
            if (event.target.rel === this.sort) {
                this.sortDirection = this.sortDirection === 'desc'
                    ? ''
                    : 'desc';
            } else {
                this.sortDirection = '';
            }
            this.sort = event.target.rel;
            this.removeSortClick();
            this.removePageClick();
            this.newsList();
        },

        addPageClick() {
            this.addClickListener(' pageLink', this.pageClick);
        },
        removePageClick() {
            this.removeClickListener(' pageLink', this.pageClick);
        },
        pageClick(event) {
            event.preventDefault();
            if (event.target.rel === '+') {
                this.page += 1;
            } else {
                this.page -= 1;
            }
            this.removeSortClick();
            this.removePageClick();
            this.newsList();
        },

        addBackLinkClick() {
            this.addClickListener('backLink', this.backLinkClick);
        },
        removeBackLinkClick() {
            this.removeClickListener('backLink', this.backLinkClick);
        },
        backLinkClick(event) {
            event.preventDefault();
            this.removeBackLinkClick();
            this.newsList()
        },

        addClickListener(className, callback) {
            const elements = document.getElementsByClassName(className);
            for (let i = 0; i < elements.length; i++) {
                elements[i].addEventListener('click', callback.bind(this));
            }
        },
        removeClickListener(className, callback) {
            const elements = document.getElementsByClassName(className);
            for (let i = 0; i < elements.length; i++) {
                elements[i].removeEventListener('click', callback.bind(this));
            }
        },
    };
    news.newsList();
};
