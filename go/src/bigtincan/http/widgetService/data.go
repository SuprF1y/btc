/**
 * Widget Persistence layer
 * Author: willem.j.homan@gmail.com
 * Date: 13/09/17
 * Time: 12:59 PM
 */
package widgetService

import (
	"errors"
)

var widgets = []Widget{
	{ID: "geo", Name: "Geolocation"},
	{ID: "events", Name: "Events"},
	{ID: "staff", Name: "Staff"},
	{ID: "sync", Name: "File sync"},
	{ID: "test", Name: "Test"},
}
/**
 * find a widget by id
 */
func FindById(id string) (*Widget, error) {
	for _, widget := range widgets {
		if widget.ID == id {
			return &widget, nil
		}
	}
	return nil, errors.New("no Widget with id: " + id)
}
/**
 * find all widgets
 */
func FindAll() ([]Widget, error) {
	return widgets, nil
}
