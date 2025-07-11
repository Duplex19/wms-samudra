@props(['id' => 'loadingOverlay'])
<style>
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .loading-popup {
        background-color: white;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        display: flex;
        justify-content: center;
        align-items: center;
        min-width: 120px;
        min-height: 120px;
    }

    .custom-spinner {
        width: 40px;
        height: 40px;
        border: 3px solid #e0e0e0;
        border-top: 3px solid #2563eb;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Demo background styles */
    .demo-background {
        background-color: #f8f9fa;
        min-height: 100vh;
        padding: 20px;
    }

    .demo-content {
        max-width: 400px;
        margin: 0 auto;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-demo {
        background-color: #2563eb;
        border-color: #2563eb;
        color: white;
        font-weight: 500;
        padding: 12px 30px;
        border-radius: 25px;
    }

    .btn-demo:hover {
        background-color: #008a10;
        border-color: #008a10;
        color: white;
    }
</style>
<div class="loading-overlay d-none" id="{{ $id }}">
    <div class="loading-popup">
        <div class="custom-spinner"></div>
    </div>
</div>