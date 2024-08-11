{block name=content}
    {include file="components/insert_assets.tpl" asset_path="assets/js/pages/counter.ts"}
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-sm text-center" style="width: 100%; max-width: 400px;">
            <!-- Loader Icon -->
            <div id="Loader" class="loader-icon">
                <div class="spinner-border text-primary spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <!-- Counter Display -->
            <div id="Counter" class="counter-display">{$counter}</div>

            <!-- Username Display -->
            <div class="username-display">{$user_name}</div>

            <!-- Buttons -->
            <div class="button-group w-100">
                <button id="IncrementBtn" class="btn btn-primary">+1</button>
                <a href="/logout" class="btn btn-danger">Exit</a>
            </div>
        </div>
    </div>
{/block}