@php
    [$id] = variables($variables);
    $model = modelById($id)->canFake(false);
    $children = $model->getChildren();
    // If model is part of a list (has ~ in the id), it can be deleted
    $isListItem = str_contains($id, '~');
    // If id ends with -, redirect to the parent without the last pointer
    $parent = $model->getParentId();
    if (str_ends_with($parent, '-')) {
        $parentParts = explode('/', $parent);
        array_pop($parentParts);
        $parent = implode('/', $parentParts);
    }
@endphp

<div class="container py-6 px-6 mx-auto max-w-4xl grid">
    @include('admin.breadcrumbs', ['currentId' => $id])
    <div id="main">
        @foreach($children as $child)
            @php($component = $child->getComponent())
            @if($component->type === 'root')
                <a href="/admin{{ $child->getId() }}">
                    <div class="flex mt-10 p-5 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                        {{ $component->getLabel() }}
                        <div class="ml-auto">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5l7 7-7 7"></path>
                            </svg>
                            <div>
                            </div>
                        </div>
                    </div>
                </a>
                @continue
            @endif
            <div>
                @include($child->getViewAdminInput(), ['model' => $child])
            </div>
        @endforeach
        <div class="mt-16 mb-16 loader _loading-hide"
             id="actions_bottom">
            <script type="module">
                import {Storage} from '/admin/assets/js/admin_service.mjs';
                import {html, reactive} from 'https://esm.sh/@arrow-js/core';

                const id = '{{ $id }}';
                let state = {countThis: countThis(), countAll: countAll(), confirmDelete: false, waiting: false};
                state = reactive(state);
                window.addEventListener('local_content_changed', () => {
                    state.countThis = countThis();
                    state.countAll = countAll();
                });

                // When the parent value is never set, this item is new.
                // Every (new) item needs to be saved.
                // This value can be used to determine the order.
                @if($model->get() === null && $isListItem)
                    if (localStorage.getItem('{{ $model->getId() }}') === null) {
                        localStorage.setItem('{{ $model->getId() }}', JSON.stringify(Date.now()));
                    }
                @endif

                function countThis() {
                    return Storage.getLocalStorageItems('{{ $id }}').length;
                }
                function countAll() {
                    return Storage.getLocalStorageItems('/model').length;
                }

                function addLoaderBtn(element) {
                    element.classList.add('_loading-blur');
                    return true
                }

                function removeLoaderBtn(element) {
                    element.classList.remove('_loading-blur');
                    return true
                }

                function publish(e, all = false) {
                    addLoaderBtn(e.target);
                    const publishFromId = all ? '/model' : id;
                    Storage.saveFromLocalStorage('{{ getServiceApi() }}', publishFromId).then((result) => {
                        if (result) {
                            if (Storage.hasRedirectUrl())
                                Storage.handleRedirectUrl();
                            else if ('{{ $id }}'.includes('~')) {
                                Storage.redirectAway('{{ $parent }}');
                            } else {
                                document.location.reload();
                            }
                        } else {
                            removeLoaderBtn(e.target)
                        }
                    })
                }

                let hasOtherChanges = state.countAll > 1 || (state.countAll !== state.countThis);

                html`
                <div class="flex flex-row w-full space-x-4">
                    @if($isListItem)
                    <button type="button" class="${() => `basis-1/4 px-5 flex items-center justify-center text-sm font-medium leading-5 text-white cursor-pointer ${state.confirmDelete ? `bg-emerald-700 hover:bg-red-600` : `bg-emerald-700 hover:bg-emerald-800`} border border-transparent rounded-md`}"
                            @click="${(e) => state.confirmDelete ? addLoaderBtn(e.target) && Storage.delete('{{ getServiceApi() }}', id, ()=> Storage.handleRedirectUrl() || Storage.redirectAway('{{ $parent }}')) && removeLoaderBtn(e.target) : state.confirmDelete = true}">
                        <span>${() => state.confirmDelete ? `Confirm` : `Delete`}</span>
                    </button>
                    @endif
                    <a href="/admin{{ $parent }}"
                       class="basis-1/4 px-5 py-3 flex items-center justify-center text-sm font-medium leading-5 text-white bg-emerald-700 hover:bg-emerald-800 border border-transparent rounded-md">
                        Back
                    </a>
                    <div class="${() => `{{ $isListItem ? 'basis-1/2' : 'basis-3/4 ' }} _loader_btn flex items-center justify-center text-sm font-medium leading-5`}" role="group">
                        ${() => hasOtherChanges ? html`
                            <button class="px-5 py-3 flex items-center justify-center w-full border rounded-s-lg text-white bg-emerald-700 hover:bg-emerald-800 border-transparent cursor-pointer" @click="${(e) => publish(e, true)}">Publish All</button>
                        ` : ''}
                        <button class="${() => `px-5 py-3 flex items-center justify-center w-full border ` + (hasOtherChanges ? `rounded-e-lg border-s-white  `: `rounded-md `) + (state.countThis > 0 ? `text-white bg-emerald-700 hover:bg-emerald-800 border-transparent cursor-pointer` : `border-gray-700 disabled`)}" @click="${(e) => publish(e)}" disabled="${() => state.countThis > 0 ? false : `disabled`}">${() => state.countThis > 0 ? (hasOtherChanges ? `Publish this` : `Publish`) : (state.countThis !== state.countAll ? `No Changes Here` : `Nothing to publish`)}</button>
                    </div>
                </div>
                `(document.getElementById('actions_bottom'));
                // When document is ready, remove the loading state
                document.addEventListener('DOMContentLoaded', () => document.querySelector('.loader').classList.remove('_loading-hide'));
            </script>
        </div>
    </div>
    @if(count($children) === 0)
        <div class="flex items-center justify-center w-full px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-emerald-800 border border-transparent rounded-lg active:bg-emerald-700 hover:bg-emerald-800 focus:outline-hidden focus:shadow-outline-emerald">
            <a href="/admin/{{ $id . '/~' . newId() }}">Create your first page</a>
        </div>
    @endif
</div>
