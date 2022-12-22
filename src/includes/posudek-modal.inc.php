<!-- Modal -->
          <div id="recenzeModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detail recenze</h4>
                </div>
                
                <div class="modal-body">
                  <form action="#" method="post" class="form-add-article" enctype="multipart/form-data">
                    <input type="hidden" name="clanekId" id="clanek-id">

                    <input type="text"   id="text" name="text" placeholder="Text posudku" disabled>
                    <input type="number" id="hod1" name="hodnoceni1" min="1" max="5" placeholder="Aktuálnost (1-5)" disabled>
                    <input type="number" id="hod2" name="hodnoceni2" min="1" max="5" placeholder="Zajímavost (1-5)" disabled>
                    <input type="number" id="hod3" name="hodnoceni3" min="1" max="5" placeholder="Přínosnost (1-5)" disabled>
                    <input type="number" id="hod4" name="hodnoceni4" min="1" max="5" placeholder="Originalita (1-5)" disabled>
                    <input type="number" id="hod5" name="hodnoceni5" min="1" max="5" placeholder="Odborná úroveň (1-5)" disabled>
                    <input type="number" id="hod6" name="hodnoceni6" min="1" max="5" placeholder="jazyková a stylistická úroveň (1-5)" disabled>
                  </form>
                </div>
                
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
                </div>
              </div>
            </div>
          </div>