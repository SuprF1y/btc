/**
 * REST controller endpoint for widgets
 * Author: willem.j.homan@gmail.com
 * Date: 13/09/17
 * Time: 12:59 PM
 */
package widgetService
import(
	"net/http"
	"github.com/asaskevich/govalidator"
	"encoding/json"
	"github.com/gorilla/mux"
)

/**
 * data structure for a widget
 */
type Widget struct {
	ID        string   `json:"id,omitempty"`
	Name	  string   `json:"name,omitempty"`
}

/**
 * error struct for REST response
 */
type Error struct {
	Type    string `json:"type,omitempty"`
	Code    string `json:"code,omitempty"`
	Message string `json:"message,omitempty"`
}


/**
 * get all widgets
 */

func GetAllWidgets(w http.ResponseWriter, req *http.Request) {
	var widgets, err = FindAll()
	w.Header().Set("Content-Type", "application/json")
	if err == nil {
		w.WriteHeader(http.StatusOK)
		json.NewEncoder(w).Encode(widgets)
	}else{
		w.WriteHeader(http.StatusNotFound)
	}
}



/**
 * get a widget by id
 */
func GetWidgetById(w http.ResponseWriter, req *http.Request) {
	var errors []Error
	params := mux.Vars(req)
	id := params["id"]
	w.Header().Set("Content-Type", "application/json")

	// validate input
	if ! govalidator.IsAlpha(id) {
		errors = append(errors, Error{Type: "InputValidationException", Code: "ERR-00001", Message: "widget ids may only contain letters"})
		w.WriteHeader(http.StatusBadRequest)
		json.NewEncoder(w).Encode(errors)
		return
	}

	// find the widget by id
	var widget, err = FindById(id)

	// return json encode
	if err == nil {
		// widget if found
		w.WriteHeader(http.StatusOK)
		json.NewEncoder(w).Encode(widget)
	}else{
		// empty object if not found
		w.WriteHeader(http.StatusNotFound)
	}
}

