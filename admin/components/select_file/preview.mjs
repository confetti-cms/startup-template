// noinspection GrazieInspection

export default class {
    id;
    value;

    /**
     * @param {string} id
     * @param {any} value
     * @param component {object}
     * For example:
     * {
     *   "decorations": {                     |
     *     "label": {                         |
     *      ^^^^^                             | The name of the decoration method
     *        "label": "Choose your template" |
     *         ^^^^^                          | The name of the parameter
     *                  ^^^^^^^^^^^^^^^^^^^^  | The value given to the parameter
     *     }
     *   },
     *   "key": "/model/view/features/select_file_basic/value-",
     *   "source": {"directory": "view/features", "file": "select_file_basic.blade.php", "from": 5, "line": 2, "to": 28},
     * }
     */
    constructor(id, value, component) {
        this.id = id;
        this.value = value;
    }

    toHtml() {
        if (this.id === undefined || this.value === undefined) {
            console.error(`The id is ${this.id} and value is ${this.value} select_file/preview.mjs`);
            return '';
        }

        // Get all after the last slash
        let value = this.value.split('/').pop();

        // And all before the first dot
        value = value.split('.')[0];

        // Replace all underscores and dashes with spaces
        value = value.replace(/_/g, ' ').replace(/-/g, ' ');

        // And make a title of this
        value = value.charAt(0).toUpperCase() + value.slice(1);

        return `<div class="p-3">${value}</div>`;
    }
}
