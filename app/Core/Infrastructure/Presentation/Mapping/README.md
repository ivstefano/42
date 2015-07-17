# Composite Mapping (How To)
##Created (15-07-2015)

Composite Mapping is an improved way for mapping and parsing backend and frontend data.

The composite mapping implements logic which takes care that the concerns in each class are separated.
Composite Mapping consists of:

* **Mapper** - Class containing the logic used for parsing the raw data by using meta-data from the Map classes
* **MapBase** - Class containing implemented required logic that each of the Map classes uses (Such as: getting
and setting the mapping array, parsing functions, etc.)
* **Mappable** - Interface specifying what kind of functions a map would have. Used as a type hint in the Mapper
constructor. Check Inversion of Control for reference.
* **Collection** - A simple object performing Mapper operations for multiple rows of raw data (data that is
going to be parsed)


##Quick example of using all
Lets say you want to use the same mapper for a single and multiple parsing of data. We can take item invoice for example.
    
    // It is preferable if you can inject the ItemMap
    $map = new ItemMap; 
    $mapper = new Mapper($map);

    $items = $itemService->getItems($type);
    $output = $mapper->toFront($items);

    // It is preferable if you can inject the MagazineMap
    $magazineMap = new MagazineMap;
    $mapper->setMap($magazineMap);
    $magazines = $magazineService->getMagazines($type);
    $output = new Collection($magazines, $mapper);
    


##Using a Map (extends MapBase)
The Map holds the mapping array which is the meta-data used for converting/parsing data from back to front or from front
to back.

###Creating a Basic Map:

Creating a basic Map just involves creating a **new** Map object. The Map object can contain functions overwriting the
default parsing functions or completely new mapping:


    $itemMap = new ItemMap();


###Creating a Map With Extended Mapping:

Creating a Map might require that the mapping array to be extended with additional dynamic meta-data.

    $additionalMapping = $service->getDynamicFieldMapping($typeId);
    $itemMap = new ItemMapRecord($additionalMapping);

##Using a Mapper

###Creating the Default Mapper:
To create a default mapper do an instance of *Mapper* and pass a Map object which would be used when parsing
the appropriate data by the mapper. **NOTE:** The Mapper is used to parse a single row.

    $mapper = new Mapper($itemMap);

Or you could add an anonymous Map object:

    $itemMap = new Mapper(new ITemMap());


###Creating an Extended Mapper:
Sometimes you might need to add additional functionality to a mapper (for example to tell the mapper to preserve the
original data types as they were in the data source) In such cases the default *Mapper* should be extended
and the conversion function should call the parent (the default mapper) to acquire the appropriate data and modify it.
Example:

    class ExtendedMapper {

        public function parseRowToFront($row) {
            $result = parent::parseRowToFront($row);
            ...
            <typecast the $result types to the appropriate ones>
            ...
            return $result;
        }
    }

When this is done, just make a new instance of the mapper and pass it the appropriate Map for the case.

    $extended = new ExtendedMapper(
        new ItemMapRecord(
            $service->getDynamicFieldMapping($itemType)
        )
    );

###Altering the Map of a Mapper
Sometimes we might have multiple conversions for different Maps. In such cases the function `setMap` of the Mapper should
be used to inject the new mapping.

    $mapper = new Mapper();

    // Map item data
    $mapper->setMap(new ItemMap());
    $item = $mapper->toFront($itemRow);

    // Map some item data
    $mapper->setMap(new ItemMap());
    $itemHeader = $mapper->toFront($itemRow);


##Parsing Data Using the Mapper
The mapper allows us to parse a single row of information from backend to front end or from frontend to backend.

###Parsing (Back => Front)
On rear occasions parsing of a single record from backend data to frontend data is required so we can use it in the
following manner:

    $itemMapper = new Mapper(new ItemMap());

    $itemA = $service->getItemById($id);
    $parsedA = $itemMapper->toFront($itemA);

    $itemB = $service->getItemByDesc('Sample description');
    $parsedB = $itemMapper->toFront($itemB);

The resulting `$parsedA` and `$parsedB` variables will each contain an array with the frontend data to be send to the
output. The functions defined in the mapping array will be applied to the backend data to parse it to frontend. If there
is a `default` value defined in the mapping array, it would be put as a default value of the field if there is nothing to
be parsed.

###Parsing (Front => Back)
Usually, in many cases a form data is sent from the front end and it has to be parsed so it could be inserted or updated
in the persistence store. This is the equivalent of the `getMappedData` in the old version of the mapping.

    $itemMapper = new Mapper(new ItemMap());
    $backendData = $itemMapper->toBack($incomingItemsData);

The resulting `$backendData` will contain the parsed frontend data by using the Mapper::FRONT_TO_BACK_KEY_NAME functions 
in the mapping array.

##Using a Data Collection
Converting from backend to front end usually is done in a bulk so most of the time *Collection* is going to be
used.

###Creating a Collection Using a Map:
In most cases we want to give the collection some data and the map itself and let it parse the data using the default
mapper class methods which would parse accordingly to the *ItemMap* mapping array information.

    // Note: the ItemMap() can be injected as a dependency, it is usually better than creating a new instance
    $itemMap = new ItemMap(); // inject
    $collection = new Collection($rawData, $itemMap);


###Creating a Collection Using a Mapper:
In some situations we would like to specify our own mapper to be used by the collection to be able to parse multiple
rows using the Extended Mapper instead of the Default one. In such situations we pass a mapper as a second parameter
to the *Collection* constructor.


    $collection = new Collection($rawData,
        new ExtendedMapper(
            new ItemMapRecord()
        )
    );

###Setting New Raw Data in the Collection
Sometimes you might wish to set a different data to the collection that has to be parsed. To do that just simply use
`setDataRows` function of the Collection.

    $collection = new Collection($rawData,
        new ExtendedMapper(
            new ItemMapRecord()
        )
    );
    $collection->setDataRows($itemRows);

##Parsing Data Using the Collection
Parsing data in the collection is done by looping over the `$rawData` set in the constructor and applying the mapper
parser functions according to the situation

###Parsing the Collection Data (Back => Front):

If you want to get an array with each row being an array of columns then use `toFront`. It calls `parseRowToFront` in
the Mapper.

    $result = $collection->toFront();

###Parsing the Collection Data (Front => Back):
If you want to get an array with each row being an array of columns then use `toBack`. It calls `parseRowToBack` in
the Mapper.

    $result = $collection->toBack();


