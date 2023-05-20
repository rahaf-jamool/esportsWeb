<?php
namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model 
{
	protected $table = 'Blocks';

	public function webSite()
	{
		return $this->belongsTo('App\Models\WebSiteGroup', 'WebSiteGroupId', 'Id')->where('IsDeleted', False);
	}

    public function mainImage()
    {
        return $this->hasOne('App\Models\Attachment', 'ReferenceId', 'Id')
            ->where('IsDeleted', False)
            ->where('ReferenceName', class_basename($this))
            ->where('IsPrimary', True);
    }

	public function attachments()
    {
        return $this->hasMany('App\Models\Attachment', 'ReferenceId', 'Id')
                    ->where('IsDeleted', False)
                    ->where('ReferenceName', class_basename($this))
                    ->where('IsPrimary', False);
    }

    public function translations()
    {
        return $this->hasMany('App\Models\Translation', 'ReferenceId', 'Id')->where('IsDeleted', False)->where('ReferenceName', class_basename($this));
    }

    public function translation($referenceField, $locale = 'en')
    {
        if ($locale == 'en') {
            return $this->$referenceField;
        } else {
            $data = $this->hasOne('App\Models\Translation', 'ReferenceId', 'Id')
                         ->where('IsDeleted', False)
                         ->where('ReferenceName', class_basename($this))
                         ->where('ReferenceField', $referenceField)->get();
            if ($data->isNotEmpty()) {
                return $data->first()->Content;
            } else {
                return $this->$referenceField;
            }
        }
    }
}
