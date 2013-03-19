<?php
 /**
  * Representation of a Zotero Item
  * 
  * @package libZotero
  * @see        Zotero_Entry
  */

class Zotero_Item extends Zotero_Entry
{
    /**
     * @var int
     */
    public $itemVersion = 0;
    
    /**
     * @var int
     */
    public $itemKey = '';

    /**
     * @var string
     */
    public $itemType = null;
    
    /**
     * @var string
     */
    public $year = '';
    
    /**
     * @var string
     */
    public $creatorSummary = '';
    
    /**
     * @var string
     */
    public $numChildren = 0;

    /**
     * @var string
     */
    public $numTags = 0;
    
    /**
     * @var array
     */
    public $childKeys = array();
    
    /**
     * @var string
     */
    public $parentItemKey = '';
    
    /**
     * @var array
     */
    public $creators = array(); 

    /**
     * @var string
     */
    public $createdByUserID = null;
    
    /**
     * @var string
     */
    public $lastModifiedByUserID = null;
    
    /**
     * @var string
     */
    public $note = null;
    
    /**
     * @var int Represents the relationship of the child to the parent. 0:file, 1:file, 2:snapshot, 3:web-link
     */
    public $linkMode = null;
    
    /**
     * @var string
     */
    public $mimeType = null;
    
    public $parsedJson = null;
    public $etag = '';
    
    /**
     * @var string content node of response useful if formatted bib request and we need to use the raw content
     */
    public $content = null;
    
    public $bibContent = null;
    
    public $subContents = array();
    
    public $apiObject = array();
    
    public $pristine = null;
    
    /**
     * @var array
     */
    public static $fieldMap = array(
        "creator"             => "Creator",
        "itemType"            => "Type",
        "title"               => "Title",
        "dateAdded"           => "Date Added",
        "dateModified"        => "Modified",
        "source"              => "Source",
        "notes"               => "Notes",
        "tags"                => "Tags",
        "attachments"         => "Attachments",
        "related"             => "Related",
        "url"                 => "URL",
        "rights"              => "Rights",
        "series"              => "Series",
        "volume"              => "Volume",
        "issue"               => "Issue",
        "edition"             => "Edition",
        "place"               => "Place",
        "publisher"           => "Publisher",
        "pages"               => "Pages",
        "ISBN"                => "ISBN",
        "publicationTitle"    => "Publication",
        "ISSN"                => "ISSN",
        "date"                => "Date",
        "section"             => "Section",
        "callNumber"          => "Call Number",
        "archiveLocation"     => "Loc. in Archive",
        "distributor"         => "Distributor",
        "extra"               => "Extra",
        "journalAbbreviation" => "Journal Abbr",
        "DOI"                 => "DOI",
        "accessDate"          => "Accessed",
        "seriesTitle"         => "Series Title",
        "seriesText"          => "Series Text",
        "seriesNumber"        => "Series Number",
        "institution"         => "Institution",
        "reportType"          => "Report Type",
        "code"                => "Code",
        "session"             => "Session",
        "legislativeBody"     => "Legislative Body",
        "history"             => "History",
        "reporter"            => "Reporter",
        "court"               => "Court",
        "numberOfVolumes"     => "# of Volumes",
        "committee"           => "Committee",
        "assignee"            => "Assignee",
        "patentNumber"        => "Patent Number",
        "priorityNumbers"     => "Priority Numbers",
        "issueDate"           => "Issue Date",
        "references"          => "References",
        "legalStatus"         => "Legal Status",
        "codeNumber"          => "Code Number",
        "artworkMedium"       => "Medium",
        "number"              => "Number",
        "artworkSize"         => "Artwork Size",
        "libraryCatalog"      => "Library Catalog",
        "videoRecordingType"  => "Recording Type",
        "interviewMedium"     => "Medium",
        "letterType"          => "Type",
        "manuscriptType"      => "Type",
        "mapType"             => "Type",
        "scale"               => "Scale",
        "thesisType"          => "Type",
        "websiteType"         => "Website Type",
        "audioRecordingType"  => "Recording Type",
        "label"               => "Label",
        "presentationType"    => "Type",
        "meetingName"         => "Meeting Name",
        "studio"              => "Studio",
        "runningTime"         => "Running Time",
        "network"             => "Network",
        "postType"            => "Post Type",
        "audioFileType"       => "File Type",
        "version"             => "Version",
        "system"              => "System",
        "company"             => "Company",
        "conferenceName"      => "Conference Name",
        "encyclopediaTitle"   => "Encyclopedia Title",
        "dictionaryTitle"     => "Dictionary Title",
        "language"            => "Language",
        "programmingLanguage" => "Language",
        "university"          => "University",
        "abstractNote"        => "Abstract",
        "websiteTitle"        => "Website Title",
        "reportNumber"        => "Report Number",
        "billNumber"          => "Bill Number",
        "codeVolume"          => "Code Volume",
        "codePages"           => "Code Pages",
        "dateDecided"         => "Date Decided",
        "reporterVolume"      => "Reporter Volume",
        "firstPage"           => "First Page",
        "documentNumber"      => "Document Number",
        "dateEnacted"         => "Date Enacted",
        "publicLawNumber"     => "Public Law Number",
        "country"             => "Country",
        "applicationNumber"   => "Application Number",
        "forumTitle"          => "Forum/Listserv Title",
        "episodeNumber"       => "Episode Number",
        "blogTitle"           => "Blog Title",
        "caseName"            => "Case Name",
        "nameOfAct"           => "Name of Act",
        "subject"             => "Subject",
        "proceedingsTitle"    => "Proceedings Title",
        "bookTitle"           => "Book Title",
        "shortTitle"          => "Short Title",
        "docketNumber"        => "Docket Number",
        "numPages"            => "# of Pages"
    );
    
    /**
     * @var array
     */
    public static $typeMap = array(
        "note"                => "Note",
        "attachment"          => "Attachment",
        "book"                => "Book",
        "bookSection"         => "Book Section",
        "journalArticle"      => "Journal Article",
        "magazineArticle"     => "Magazine Article",
        "newspaperArticle"    => "Newspaper Article",
        "thesis"              => "Thesis",
        "letter"              => "Letter",
        "manuscript"          => "Manuscript",
        "interview"           => "Interview",
        "film"                => "Film",
        "artwork"             => "Artwork",
        "webpage"             => "Web Page",
        "report"              => "Report",
        "bill"                => "Bill",
        "case"                => "Case",
        "hearing"             => "Hearing",
        "patent"              => "Patent",
        "statute"             => "Statute",
        "email"               => "E-mail",
        "map"                 => "Map",
        "blogPost"            => "Blog Post",
        "instantMessage"      => "Instant Message",
        "forumPost"           => "Forum Post",
        "audioRecording"      => "Audio Recording",
        "presentation"        => "Presentation",
        "videoRecording"      => "Video Recording",
        "tvBroadcast"         => "TV Broadcast",
        "radioBroadcast"      => "Radio Broadcast",
        "podcast"             => "Podcast",
        "computerProgram"     => "Computer Program",
        "conferencePaper"     => "Conference Paper",
        "document"            => "Document",
        "encyclopediaArticle" => "Encyclopedia Article",
        "dictionaryEntry"     => "Dictionary Entry",
    );
    
    /**
     * @var array
     */
    public static $creatorMap = array(
        "author"         => "Author",
        "contributor"    => "Contributor",
        "editor"         => "Editor",
        "translator"     => "Translator",
        "seriesEditor"   => "Series Editor",
        "interviewee"    => "Interview With",
        "interviewer"    => "Interviewer",
        "director"       => "Director",
        "scriptwriter"   => "Scriptwriter",
        "producer"       => "Producer",
        "castMember"     => "Cast Member",
        "sponsor"        => "Sponsor",
        "counsel"        => "Counsel",
        "inventor"       => "Inventor",
        "attorneyAgent"  => "Attorney/Agent",
        "recipient"      => "Recipient",
        "performer"      => "Performer",
        "composer"       => "Composer",
        "wordsBy"        => "Words By",
        "cartographer"   => "Cartographer",
        "programmer"     => "Programmer",
        "reviewedAuthor" => "Reviewed Author",
        "artist"         => "Artist",
        "commenter"      => "Commenter",
        "presenter"      => "Presenter",
        "guest"          => "Guest",
        "podcaster"      => "Podcaster"
    );
    
    
    public function __construct($entryNode=null, $library=null)
    {
        if(!$entryNode){
            return;
        }
        elseif(is_string($entryNode)){
            $xml = $entryNode;
            $doc = new DOMDocument();
            $doc->loadXml($xml);
            $entryNode = $doc->getElementsByTagName('entry')->item(0);
        }
        
        parent::__construct($entryNode);
        
        //check if we have multiple subcontent nodes
        $subcontentNodes = $entryNode->getElementsByTagNameNS("http://zotero.org/ns/api", "subcontent");
        
        //save raw Content node in case we need it
        /*
        if($entryNode->getElementsByTagName("content")->length > 0){
            $d = $entryNode->ownerDocument;
            $this->contentNode = $entryNode->getElementsByTagName("content")->item(0);
            $this->content = $d->saveXml($this->contentNode);
        }
        */
        // Extract the zapi elements: object key, version, itemType, year, numChildren, numTags
        $this->itemKey = $entryNode->getElementsByTagNameNS('http://zotero.org/ns/api', 'key')->item(0)->nodeValue;
        $this->itemVersion = $entryNode->getElementsByTagNameNS('http://zotero.org/ns/api', 'version')->item(0)->nodeValue;
        $this->itemType = $entryNode->getElementsByTagNameNS('http://zotero.org/ns/api', 'itemType')->item(0)->nodeValue;
        // Look for numTags node
        // this may be always present in v2 api
        $numTagsNode = $entryNode->getElementsByTagNameNS('http://zotero.org/ns/api', "numTags")->item(0);
        if($numTagsNode){
            $this->numTags = $numTagsNode->nodeValue;
        }
        
        // Look for year node
        $yearNode = $entryNode->getElementsByTagNameNS('http://zotero.org/ns/api', "year")->item(0);
        if($yearNode){
            $this->year = $yearNode->nodeValue;
        }
        
        // Look for numChildren node
        $numChildrenNode = $entryNode->getElementsByTagNameNS('http://zotero.org/ns/api', "numChildren")->item(0);
        if($numChildrenNode){
            $this->numChildren = $numChildrenNode->nodeValue;
        }
        
        // Look for creatorSummary node - only present if there are non-empty creators
        $creatorSummaryNode = $entryNode->getElementsByTagNameNS('http://zotero.org/ns/api', "creatorSummary")->item(0);
        if($creatorSummaryNode){
            $this->creatorSummary = $creatorSummaryNode->nodeValue;
        }
        
        // pull out and parse various subcontent nodes, or parse the single content node
        if($subcontentNodes->length > 0){
            for($i = 0; $i < $subcontentNodes->length; $i++){
                $scnode = $subcontentNodes->item($i);
                $this->parseContentNode($scnode);
            }
        }
        else{
            $contentNode = $entryNode->getElementsByTagName('content')->item(0);
            $this->parseContentNode($contentNode);
        }
        
        //don't parse 'up' link, just depend on parentItem in json
        /*
        if(isset($this->links['up'])){
            $parentLink = $this->links['up']['application/atom+xml']['href'];
            $matches = array();
            preg_match("/items\/([A-Z0-9]{8})/", $parentLink, $matches);
            if(count($matches) == 2){
                $this->parentItemKey = $matches[1];
            }
        }
        else{
            $this->parentItemKey = false;
        }
        */
        
        if($library !== null){
            $this->associateWithLibrary($library);
        }
    }
    
    public function parseContentNode($node){
        $type = $node->getAttributeNS('http://zotero.org/ns/api', 'type');
        if($type == 'application/json' || $type == 'json'){
            $this->pristine = json_decode($node->nodeValue, true);
            $this->apiObject = json_decode($node->nodeValue, true);
            $this->apiObj = &$this->apiObject;
            if(isset($this->apiObject['creators'])){
                $this->creators = $this->apiObject['creators'];
            }
            else{
                $this->creators = array();
            }
            $this->itemVersion = isset($this->apiObject['itemVersion']) ? $this->apiObject['itemVersion'] : 0;
            $this->parentItemKey = isset($this->apiObject['parentItem']) ? $this->apiObject['parentItem'] : false;
            
            if($this->itemType == 'attachment'){
                $this->mimeType = $this->apiObject['contentType'];
                $this->translatedMimeType = Zotero_Lib_Utils::translateMimeType($this->mimeType);
            }
            if(array_key_exists('linkMode', $this->apiObject)){
                $this->linkMode = $this->apiObject['linkMode'];
            }
            $this->synced = true;
        }
        elseif($type == 'bib'){
            $bibNode = $node->getElementsByTagName('div')->item(0);
            $this->bibContent = $bibNode->ownerDocument->saveXML($bibNode);
        }
        
        $contentString = '';
        $childNodes = $node->childNodes;
        foreach($childNodes as $childNode){
            $contentString .= $childNode->ownerDocument->saveXML($childNode);
        }
        $this->subContents[$type] = $contentString;
    }
    
    public function initItemFromTemplate($template){
        $this->itemVersion = 0;
        
        $this->itemType = $template['itemType'];
        $this->itemKey = '';
        $this->pristine = $template;
        $this->apiObject = $template;
    }
    
    public function get($key){
        switch($key){
            case 'title':
                return $this->title;
            case 'creatorSummary':
                return $this->creatorSummary;
            case 'year':
                return $this->year;
            case 'parentItem':
            case 'parentItemKey':
                return $this->parentItemKey;
        }
        
        if(array_key_exists($key, $this->apiObject)){
            return $this->apiObject[$key];
        }
        
        if(property_exists($this, $key)){
            return $this->$key;
        }
    }
    
    public function set($key, $val){
        if(array_key_exists($key, $this->apiObject)){
            $this->apiObject[$key] = $val;
        }
        
        switch($key){
            case "itemKey":
                $this->itemKey = $val;
                $this->apiObject['itemKey'] = $val;
                break;
            case "itemVersion":
                $this->itemVersion = $val;
                $this->apiObject["itemVersion"] = $val;
                break;
            case "title":
                $this->title = $val;
                break;
            case "itemType":
                $this->itemType = $val;
                //TODO: translate api object to new item type
                break;
            case "linkMode":
                break;
            case "deleted":
                $this->apiObject["deleted"] = $val;
                break;
            case "parentItem":
            case "parentKey":
            case "parentItemKey":
                if( $val === '' ){ $val = false; }
                $this->parentItemKey = $val;
                $this->apiObject["parentItem"] = $val;
                break;
        }
    }
    
    public function addCreator($creatorArray){
        $this->creators[] = $creatorArray;
        $this->apiObject['creators'][] = $creatorArray;
    }
    
    public function updateItemObject(){
        return $this->writeApiObject();
    }
    
    public function newItemObject(){
        $newItem = $this->apiObject;
        $newCreatorsArray = array();
        if(isset($newItem['creators'])) {
            foreach($newItem['creators'] as $creator){
                if($creator['creatorType']){
                    if(empty($creator['name']) && empty($creator['firstName']) && empty($creator['lastName'])){
                        continue;
                    }
                    else{
                        $newCreatorsArray[] = $creator;
                    }
                }
            }
            $newItem['creators'] = $newCreatorsArray;
        }
        
        return $newItem;
    }
    
    public function isAttachment(){
        if($this->itemType == 'attachment'){
            return true;
        }
    }
    
    public function hasFile(){
        if(!$this->isAttachment()){
            return false;
        }
        $hasEnclosure = isset($this->links['enclosure']);
        $linkMode = $this->apiObject['linkMode'];
        if($hasEnclosure && ($linkMode == 0 || $linkMode == 1)){
            return true;
        }
    }
    
    public function attachmentIsSnapshot(){
        if(!isset($this->links['enclosure'])) return false;
        if(!isset($this->links['enclosure']['text/html'])) return false;
        $tail = substr($this->links['enclosure']['text/html']['href'], -4);
        if($tail == "view") return true;
        return false;
    }
    
    public function json(){
        return json_encode($this->apiObject());
    }
    /*
    public function fullItemJSON(){
        return json_encode($this->fullItemArray());
    }
    
    public function fullItemArray(){
        $jsonItem = array();
        
        //inherited from Entry
        $jsonItem['title'] = $this->title;
        $jsonItem['dateAdded'] = $this->dateAdded;
        $jsonItem['dateUpdated'] = $this->dateUpdated;
        $jsonItem['id'] = $this->id;
        
        $jsonItem['links'] = $this->links;
        
        //Item specific vars
        $jsonItem['itemKey'] = $this->itemKey;
        $jsonItem['itemType'] = $this->itemType;
        $jsonItem['creatorSummary'] = $this->creatorSummary;
        $jsonItem['numChildren'] = $this->numChildren;
        $jsonItem['numTags'] = $this->numTags;
        
        $jsonItem['creators'] = $this->creators;
        $jsonItem['createdByUserID'] = $this->createdByUserID;
        $jsonItem['lastModifiedByUserID'] = $this->lastModifiedByUserID;
        $jsonItem['note'] = $this->note;
        $jsonItem['linkMode'] = $this->linkMode;
        $jsonItem['mimeType'] = $this->mimeType;
        
        $jsonItem['apiObject'] = $this->apiObject;
        return $jsonItem;
    }
    */
    public function formatItemField($field){
        switch($field){
            case "title":
                return htmlspecialchars($this->title);
                break;
            case "creator":
                if(isset($this->creatorSummary)){
                    return htmlspecialchars($this->creatorSummary);
                }
                else{
                    return '';
                }
                break;
            case "dateModified":
            case "dateUpdated":
                return htmlspecialchars($this->dateUpdated);
                break;
            case "dateAdded":
                return htmlspecialchars($this->dateAdded);
                break;
            default:
                if(isset($this->apiObject[$field])){
                    return htmlspecialchars($this->apiObject[$field]);
                }
                else{
                    return '';
                }
        }
    }
    
    public function compareItem($otherItem){
        $diff = array_diff_assoc($this->apiObject, $otherItem->apiObject);
        return $diff;
    }
    
    public function addToCollection($collection){
        
    }
    
    public function removeFromCollection($collection){
        
    }
    
    public function uploadFile(){
        
    }
    
    public function uploadChildAttachment(){
        
    }
    
    public function writeApiObject(){
        $updateItem = array_merge($this->pristine, $this->apiObject);
        return $updateItem;
    }
    
    public function writePatch(){
        
    }
    
    public function getChildren(){
        //short circuit if has item has no children
        if(!($this->numChildren)){//} || (this.parentItemKey !== false)){
            return array();
        }
        
        $config = array('target'=>'children', 'libraryType'=>$this->libraryType, 'libraryID'=>$this->libraryID, 'itemKey'=>$this->itemKey, 'content'=>'json');
        $requestUrl = $this->owningLibrary->apiRequestUrl($config) . $this->owningLibrary->apiQueryString($config);
        
        $response = $this->owningLibrary->_request($requestUrl, 'GET');
        
        //load response into item objects
        $fetchedItems = array();
        if($response->isError()){
            return false;
            throw new Exception("Error fetching items");
        }
        
        $feed = new Zotero_Feed($response->getRawBody());
        $fetchedItems = $this->owningLibrary->items->addItemsFromFeed($feed);
        return $fetchedItems;
    }
}
