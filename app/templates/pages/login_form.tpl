{block name=content}
    {include file="components/insert_assets.tpl" asset_path="assets/js/pages/login_form.ts"}
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-sm position-relative" style="width: 100%; max-width: 400px;">
            <h2 class="text-center mb-4">Login</h2>
            <!-- Loader Overlay -->
            <div class="loader-overlay" id="LoaderOverlay">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <form id="LoginForm">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="Username" placeholder="Enter your username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="Password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Enter</button>
            </form>
        </div>
    </div>
{/block}