@php /** @var \App\Components\BoolComponent $model */ @endphp
        <!--suppress HtmlUnknownTag -->
<tally-component
        data-id="{{ $model->getId() }}"
        data-label="{{ $model->getComponent()->getLabel() }}"
        data-decorations='{{ json_encode($model->getComponent()->getDecorations()) }}'
        data-original="{{ json_encode($model->get()) }}"
        data-component="{{ json_encode($model->getComponent()) }}"
        data-service_api="{{ getServiceApi() }}"
></tally-component>

@pushonce('end_of_body_tally_component')
    <script type="module">
        import {Toolbar} from '/admin/assets/js/editor.mjs';
        import {Storage} from '/admin/assets/js/admin_service.mjs';
        import {IconUndo, IconMarker, IconTableWithHeadings} from 'https://esm.sh/@codexteam/icons';
        import {html, reactive} from 'https://esm.sh/@arrow-js/core';

        customElements.define('tally-component', class extends HTMLElement {
            id
            label
            original
            data = {
                value: {
                    share_link: '',
                    embed_url: '',
                    admin_url: '',
                },
                error: null,
            }
            decorations = {
                required: {default: false},
            }
            serviceApi = null

            constructor() {
                super();
                this.id = this.dataset.id;
                this.label = this.dataset.label;
                this.original = JSON.parse(this.dataset.original);
                this.decorations = JSON.parse(this.dataset.decorations);
                this.data = reactive({
                    value: Storage.getFromLocalStorage(this.id) || this.original || null,
                    error: null,
                });
                this.serviceApi = this.dataset.service_api;
            }

            connectedCallback() {
                this.data.$on('value', value => {
                    Storage.removeLocalStorageModels(this.id);
                    if (value !== this.original) {
                        Storage.saveLocalStorageModel(this.id, value, this.dataset.component);
                    }
                    window.dispatchEvent(new CustomEvent('local_content_changed'));
                });

                html`
                    <label class="block text-bold text-xl mt-8 mb-4">${this.label}</label>
                    <div class="w-full flex gap-4">
                        <input class="${() => `appearance-none pr-5 pl-3 py-3 bg-gray-50 border-2 outline-hidden text-gray-900 rounded-lg block ${this.data.value?.name ? `w-1/2` : `w-full`} ${this.data.value === this.original ? `border-gray-200` : `border-emerald-300`}`}"
                               name="${this.id}"
                               value="${() => this.data.value?.share_link ?? ''}"
                               placeholder="https://tally.so/r/..."
                               @input="${e => this.#storeChange(e.target.value)}"/>
                        ${() => this.data.value?.name ? html`
                            <div class="w-1/2 flex items-center">
                                <a href="${() => this.data.value?.admin_url}" target="_blank">
                                    <span class="text-gray-500">${this.data.value.name}</span>
                                </a>
                            </div>
                        ` : html``}
                    </div>

                    ${() => this.data.error ? html`<p class="mt-2 text-red-500">${this.data.error}</p>` : html``}

                    ${() => !this.data.value?.share_link || this.data.error ? html`
                        <h3 class="text-lg font-semibold mt-4">How to set up a Tally form?</h3>
                        <ol class="mt-2 text-gray-500 list-decimal pl-4">
                            <li>Go to
                                <a href="https://tally.so/signup" target="_blank" class="text-blue-500 underline">Tally</a> and create an account.
                            </li>
                            <li>Create a
                                <a href="https://tally.so/forms/create" target="_blank" class="text-blue-500 underline">new form</a> or open an
                                <a href="https://tally.so/dashboard" target="_blank" class="text-blue-500 underline">existing form</a>.
                            </li>
                            <li>Go to the "Publish" section or the "Share" tab.</li>
                            <li>Copy the link under the "Share Link" section.</li>
                            <li>Paste the link into the input above.</li>
                        </ol>
                    ` : html``}
                `(this);

                new Toolbar(this).init([
                        {
                            label: 'Remove unpublished changes',
                            icon: IconUndo,
                            closeOnActivate: true,
                            onActivate: async () => {
                                this.querySelector('input').value = this.original;
                                this.querySelector('input').dispatchEvent(new Event('change'));
                                this.data.value = this.original || null;
                            }
                        },
                        {
                            label: 'Edit form',
                            icon: IconMarker,
                            closeOnActivate: true,
                            onActivate: () => window.open(this.data.value?.admin_url, '_blank'),
                            disabled: !this.data.value?.admin_url,
                        },
                        {
                            label: 'Open form',
                            icon: IconTableWithHeadings,
                            closeOnActivate: true,
                            onActivate: () => window.open(this.data.value?.share_link, '_blank'),
                            disabled: !this.data.value?.share_link,
                        },
                    ],
                );

                // We need to save some value (with component) to show it in the list
                if (this.data.value === null) {
                    Storage.saveLocalStorageModel(this.id, this.data.value, this.dataset.component);
                }

                this.#validateAndInit(this.data.value?.share_link);
            }

            #validateAndInit(shareUrl) {
                if (!shareUrl) {
                    if (this.decorations.required?.required) {
                        this.data.error = 'Please enter a link to a Tally form.';
                    } else {
                        this.data.error = null;
                    }
                    this.data.value = null;
                    return false;
                }

                if (!shareUrl?.startsWith('https://tally.so/r/') || shareUrl.length < 23 || shareUrl.length > 26) {
                    this.data.error = 'The link should start with "https://tally.so/r/" and be followed by a unique identifier. For example: "https://tally.so/r/123456".';
                    return false;
                }

                // Set admin url: e.g. https://tally.so/forms/wQ8LDG
                let adminUrl = shareUrl.replace('https://tally.so/r/', 'https://tally.so/forms/');
                // Convert share url to a embed url so we don't got cors errors
                let embedUrl = shareUrl.replace('https://tally.so/r/', 'https://tally.so/embed/');
                let byPassCors = this.serviceApi + '/confetti-cms/content/bypass_cors?url=' + encodeURIComponent(embedUrl);

                // Check if the url is valid
                fetch(byPassCors)
                    .then(response => {
                        if (!response.ok) {
                            this.data.error = 'The link is not valid. Please check if the link is correct and try again.';
                            return;
                        }
                        return response.text();
                    })
                    .then(responseBody => {
                        if (!responseBody) return;

                        let match = responseBody.match(/<script id="__NEXT_DATA__" type="application\/json">(.+?)<\/script>/s);
                        if (match && match[1]) {
                            let jsonData = JSON.parse(match[1]); // Converteer de JSON-string naar een object
                            let name = jsonData.props?.pageProps?.name; // Haal de naam eruit

                            this.data.value = {
                                share_link: shareUrl,
                                embed_url: embedUrl,
                                admin_url: adminUrl,
                                name: name,
                            }
                        } else {
                            console.log("NEXT_DATA not found");
                        }
                    })
                    .catch((e) => {
                        console.error('Unexpected error occurred.', e);
                        this.data.error = 'Unexpected error occurred. Please try again later. (The developer can check the console for more information.)';
                    });
                this.data.error = null;

                return true;
            }

            #storeChange(shareUrl) {
                // Convert all possible urls to the share url. Just to make it convenient for the user.
                shareUrl = shareUrl
                    .replace('https://tally.so/forms/', 'https://tally.so/r/')
                    .replace('https://tally.so/embed/', 'https://tally.so/r/');

                // Remove /summary or /share at the end of the url in case it's there
                shareUrl = shareUrl.replace(/\/(summary|share)$/, '');

                this.#validateAndInit(shareUrl);
            }
        });
    </script>
@endpushonce