module.exports = {

    /**
     * Change the active tab.
     * Sets the class of the clicked tab to 'active'.
     * Removes the class active from siblings.
     *
     * Removes class 'hidden' from the '.key' element.
     * Adds class 'hidden' to its siblings.
     *
     * @return {void}
     */
    changeActive: function(e) {
        var key = this.getAttribute('data-key');

        var siblings = this.parentNode.children;
        
        for (var i = 0; i < siblings.length; i++) {
            siblings[i].classList.remove('active');
        }

        this.classList.add('active');

        var tab = document.querySelector('.'+key);
        var tabs = tab.parentNode.children;

        for (var i = 0; i < tabs.length; i++) {
            tabs[i].classList.add('hidden');
        }
        tab.classList.remove('hidden');
    }
}
