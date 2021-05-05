

@if(session('success') && gettype(session('success')) == 'array')
    <div class="alert alert-success" id="alert">
        <div id="content">
            <p class="message">{{ session('success')['message'] }}</p>
            <div class="planInfo">
                <div class="labels">
                    <p class="label">Remaining Time</p>
                    <p class="label">Expiration</p>
                </div>
                <div class="data">
                    <p class="text">{{ session('success')['remaining_time'] }}</p>
                    <p class="text">{{ session('success')['expiration'] }}</p>
                </div>
            </div>
        </div>
        <div id="action">
            <button id="ok">OK</button>
        </div>
    </div>
@elseif(session('success'))
    <div class="alert alert-success" id="alert">
        <div id="content">
            <p class="message">{{ session('success') }}</p>
        </div>
        <div id="action">
            <button id="ok">OK</button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-success" id="alert">
        <div id="content">
            <p class="message">{{ session('error') }}</p>
        </div>
        <div id="action">
            <button id="ok">OK</button>
        </div>
    </div>
@endif