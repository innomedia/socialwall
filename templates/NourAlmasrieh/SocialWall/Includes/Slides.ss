<div class="card shadow">
    <% if $Bild %>
        <% if $AllConfSocial %>
            <% loop $AllConfSocial %>
                <div class="card-body py-2 px-3">
                    <% if $PlatformLink %>
                        <a href="$PlatformLink" target="_blank" title="Post in neuem Tab öffnen">
                    <% end_if %>
                    <% if $ProfileImage %>
                        <img src="$ProfileImage.Fit(35,35).Link" loading="lazy" class="img-fluid profileimage d-inline-block me-3" alt="$ProfileImage.AltText">
                    <% end_if %>
                    <% if $Username %>
                        <span class="mb-0 d-inline-block h6 username">$Username</h6>
                    <% end_if %>
                    <% if $PlatformLink %>
                        </a>
                    <% end_if %>
                </div>
            <% end_loop %>
        <% else %>
            <% if $Username %>
                <div class="card-body py-2 px-3">
                    <span class="mb-0 d-inline-block username">$Username</h6>
                </div>
            <% end_if %>
        <% end_if %>
        <div class="p-0 position-relative">
            <div class="card-img-top">
                <a href="$PlatformLink" target="_blank" title="Post in neuem Tab öffnen">
                    <picture>
                        <source srcset="$Bild.FocusFill(770,770).URL" media="(min-width:768px)">
                        <source srcset="$Bild.FocusFill(1280,720).URL" media="(min-width:500px)">
                        <source srcset="$Bild.FocusFill(800,600).URL" media="(min-width:1px)">
                        <img src="$Bild.FocusFill(770,770).URL" class="img-fluid w-100" alt="$Bild.AltText">
                    </picture>
                </a>
            </div>
        </div>
        <div class="rounded-social-buttons platform__icon text-center">
            <a class="social-button facebook" href="$PlatformLink" target="_blank" title="Post in neuem Tab öffnen">
                <i class="fab $PlatformIconClass"></i>
            </a>
        </div>
        
    <% end_if %>
    <div class="card-footer equalHeight">
        <div class="p-3 p-md-4">
            <div class="row">
                <div class="col-12">
                    <p>
                        $Message.LimitCharacters(150).RAW
                    </p>
                </div>
            </div>
            <div class="row align-items-center mt-3">
                <div class="col-12">
                    <span>
                        $CreatedDate.Format('dd. MMMM. Y')
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
