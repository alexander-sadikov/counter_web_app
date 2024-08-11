{block name=content}
    {include file="components/insert_assets.tpl" asset_path="assets/js/pages/counter.ts"}
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-sm text-center" style="width: 100%; max-width: 400px;">
            <!-- Counter Display -->
            <div id="Counter" class="counter-display">0</div>

            <!-- Username Display -->
            <div class="username-display">Username</div>

            <!-- Buttons -->
            <div class="button-group w-100">
                <button id="IncrementBtn" class="btn btn-primary">+1</button>
                <button id="ExitBtn" class="btn btn-danger">Exit</button>
            </div>
        </div>
    </div>
{/block}