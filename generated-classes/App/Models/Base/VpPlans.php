<?php

namespace App\Models\Base;

use \Exception;
use \PDO;
use App\Models\VpDays as ChildVpDays;
use App\Models\VpDaysQuery as ChildVpDaysQuery;
use App\Models\VpPlans as ChildVpPlans;
use App\Models\VpPlansQuery as ChildVpPlansQuery;
use App\Models\VpUsers as ChildVpUsers;
use App\Models\VpUsersPlans as ChildVpUsersPlans;
use App\Models\VpUsersPlansQuery as ChildVpUsersPlansQuery;
use App\Models\VpUsersQuery as ChildVpUsersQuery;
use App\Models\Map\VpDaysTableMap;
use App\Models\Map\VpPlansTableMap;
use App\Models\Map\VpUsersPlansTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'vp_plans' table.
 *
 *
 *
 * @package    propel.generator.App.Models.Base
 */
abstract class VpPlans implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Models\\Map\\VpPlansTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        string
     */
    protected $id;

    /**
     * The value for the title field.
     *
     * @var        string
     */
    protected $title;

    /**
     * @var        ObjectCollection|ChildVpDays[] Collection to store aggregation of ChildVpDays objects.
     */
    protected $collVpDayss;
    protected $collVpDayssPartial;

    /**
     * @var        ObjectCollection|ChildVpUsersPlans[] Collection to store aggregation of ChildVpUsersPlans objects.
     */
    protected $collVpUsersPlanss;
    protected $collVpUsersPlanssPartial;

    /**
     * @var        ObjectCollection|ChildVpUsers[] Cross Collection to store aggregation of ChildVpUsers objects.
     */
    protected $collVpUserss;

    /**
     * @var bool
     */
    protected $collVpUserssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVpUsers[]
     */
    protected $vpUserssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVpDays[]
     */
    protected $vpDayssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVpUsersPlans[]
     */
    protected $vpUsersPlanssScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Models\Base\VpPlans object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>VpPlans</code> instance.  If
     * <code>obj</code> is an instance of <code>VpPlans</code>, delegates to
     * <code>equals(VpPlans)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|VpPlans The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of [id] column.
     *
     * @param string $v new value
     * @return $this|\App\Models\VpPlans The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[VpPlansTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\App\Models\VpPlans The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[VpPlansTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : VpPlansTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : VpPlansTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 2; // 2 = VpPlansTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Models\\VpPlans'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VpPlansTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildVpPlansQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collVpDayss = null;

            $this->collVpUsersPlanss = null;

            $this->collVpUserss = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see VpPlans::setDeleted()
     * @see VpPlans::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VpPlansTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildVpPlansQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VpPlansTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                VpPlansTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->vpUserssScheduledForDeletion !== null) {
                if (!$this->vpUserssScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->vpUserssScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getId();
                        $entryPk[0] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \App\Models\VpUsersPlansQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->vpUserssScheduledForDeletion = null;
                }

            }

            if ($this->collVpUserss) {
                foreach ($this->collVpUserss as $vpUsers) {
                    if (!$vpUsers->isDeleted() && ($vpUsers->isNew() || $vpUsers->isModified())) {
                        $vpUsers->save($con);
                    }
                }
            }


            if ($this->vpDayssScheduledForDeletion !== null) {
                if (!$this->vpDayssScheduledForDeletion->isEmpty()) {
                    \App\Models\VpDaysQuery::create()
                        ->filterByPrimaryKeys($this->vpDayssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->vpDayssScheduledForDeletion = null;
                }
            }

            if ($this->collVpDayss !== null) {
                foreach ($this->collVpDayss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->vpUsersPlanssScheduledForDeletion !== null) {
                if (!$this->vpUsersPlanssScheduledForDeletion->isEmpty()) {
                    \App\Models\VpUsersPlansQuery::create()
                        ->filterByPrimaryKeys($this->vpUsersPlanssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->vpUsersPlanssScheduledForDeletion = null;
                }
            }

            if ($this->collVpUsersPlanss !== null) {
                foreach ($this->collVpUsersPlanss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[VpPlansTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . VpPlansTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(VpPlansTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(VpPlansTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }

        $sql = sprintf(
            'INSERT INTO vp_plans (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'title':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = VpPlansTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getTitle();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['VpPlans'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['VpPlans'][$this->hashCode()] = true;
        $keys = VpPlansTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTitle(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collVpDayss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'vpDayss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'vp_dayss';
                        break;
                    default:
                        $key = 'VpDayss';
                }

                $result[$key] = $this->collVpDayss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVpUsersPlanss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'vpUsersPlanss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'vp_users_planss';
                        break;
                    default:
                        $key = 'VpUsersPlanss';
                }

                $result[$key] = $this->collVpUsersPlanss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\App\Models\VpPlans
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = VpPlansTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Models\VpPlans
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setTitle($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = VpPlansTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTitle($arr[$keys[1]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\App\Models\VpPlans The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(VpPlansTableMap::DATABASE_NAME);

        if ($this->isColumnModified(VpPlansTableMap::COL_ID)) {
            $criteria->add(VpPlansTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(VpPlansTableMap::COL_TITLE)) {
            $criteria->add(VpPlansTableMap::COL_TITLE, $this->title);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildVpPlansQuery::create();
        $criteria->add(VpPlansTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Models\VpPlans (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitle($this->getTitle());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getVpDayss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVpDays($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVpUsersPlanss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVpUsersPlans($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \App\Models\VpPlans Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('VpDays' == $relationName) {
            $this->initVpDayss();
            return;
        }
        if ('VpUsersPlans' == $relationName) {
            $this->initVpUsersPlanss();
            return;
        }
    }

    /**
     * Clears out the collVpDayss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVpDayss()
     */
    public function clearVpDayss()
    {
        $this->collVpDayss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVpDayss collection loaded partially.
     */
    public function resetPartialVpDayss($v = true)
    {
        $this->collVpDayssPartial = $v;
    }

    /**
     * Initializes the collVpDayss collection.
     *
     * By default this just sets the collVpDayss collection to an empty array (like clearcollVpDayss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVpDayss($overrideExisting = true)
    {
        if (null !== $this->collVpDayss && !$overrideExisting) {
            return;
        }

        $collectionClassName = VpDaysTableMap::getTableMap()->getCollectionClassName();

        $this->collVpDayss = new $collectionClassName;
        $this->collVpDayss->setModel('\App\Models\VpDays');
    }

    /**
     * Gets an array of ChildVpDays objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVpPlans is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVpDays[] List of ChildVpDays objects
     * @throws PropelException
     */
    public function getVpDayss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVpDayssPartial && !$this->isNew();
        if (null === $this->collVpDayss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVpDayss) {
                // return empty collection
                $this->initVpDayss();
            } else {
                $collVpDayss = ChildVpDaysQuery::create(null, $criteria)
                    ->filterByVpPlans($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVpDayssPartial && count($collVpDayss)) {
                        $this->initVpDayss(false);

                        foreach ($collVpDayss as $obj) {
                            if (false == $this->collVpDayss->contains($obj)) {
                                $this->collVpDayss->append($obj);
                            }
                        }

                        $this->collVpDayssPartial = true;
                    }

                    return $collVpDayss;
                }

                if ($partial && $this->collVpDayss) {
                    foreach ($this->collVpDayss as $obj) {
                        if ($obj->isNew()) {
                            $collVpDayss[] = $obj;
                        }
                    }
                }

                $this->collVpDayss = $collVpDayss;
                $this->collVpDayssPartial = false;
            }
        }

        return $this->collVpDayss;
    }

    /**
     * Sets a collection of ChildVpDays objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $vpDayss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildVpPlans The current object (for fluent API support)
     */
    public function setVpDayss(Collection $vpDayss, ConnectionInterface $con = null)
    {
        /** @var ChildVpDays[] $vpDayssToDelete */
        $vpDayssToDelete = $this->getVpDayss(new Criteria(), $con)->diff($vpDayss);


        $this->vpDayssScheduledForDeletion = $vpDayssToDelete;

        foreach ($vpDayssToDelete as $vpDaysRemoved) {
            $vpDaysRemoved->setVpPlans(null);
        }

        $this->collVpDayss = null;
        foreach ($vpDayss as $vpDays) {
            $this->addVpDays($vpDays);
        }

        $this->collVpDayss = $vpDayss;
        $this->collVpDayssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related VpDays objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related VpDays objects.
     * @throws PropelException
     */
    public function countVpDayss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVpDayssPartial && !$this->isNew();
        if (null === $this->collVpDayss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVpDayss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVpDayss());
            }

            $query = ChildVpDaysQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVpPlans($this)
                ->count($con);
        }

        return count($this->collVpDayss);
    }

    /**
     * Method called to associate a ChildVpDays object to this object
     * through the ChildVpDays foreign key attribute.
     *
     * @param  ChildVpDays $l ChildVpDays
     * @return $this|\App\Models\VpPlans The current object (for fluent API support)
     */
    public function addVpDays(ChildVpDays $l)
    {
        if ($this->collVpDayss === null) {
            $this->initVpDayss();
            $this->collVpDayssPartial = true;
        }

        if (!$this->collVpDayss->contains($l)) {
            $this->doAddVpDays($l);

            if ($this->vpDayssScheduledForDeletion and $this->vpDayssScheduledForDeletion->contains($l)) {
                $this->vpDayssScheduledForDeletion->remove($this->vpDayssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVpDays $vpDays The ChildVpDays object to add.
     */
    protected function doAddVpDays(ChildVpDays $vpDays)
    {
        $this->collVpDayss[]= $vpDays;
        $vpDays->setVpPlans($this);
    }

    /**
     * @param  ChildVpDays $vpDays The ChildVpDays object to remove.
     * @return $this|ChildVpPlans The current object (for fluent API support)
     */
    public function removeVpDays(ChildVpDays $vpDays)
    {
        if ($this->getVpDayss()->contains($vpDays)) {
            $pos = $this->collVpDayss->search($vpDays);
            $this->collVpDayss->remove($pos);
            if (null === $this->vpDayssScheduledForDeletion) {
                $this->vpDayssScheduledForDeletion = clone $this->collVpDayss;
                $this->vpDayssScheduledForDeletion->clear();
            }
            $this->vpDayssScheduledForDeletion[]= clone $vpDays;
            $vpDays->setVpPlans(null);
        }

        return $this;
    }

    /**
     * Clears out the collVpUsersPlanss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVpUsersPlanss()
     */
    public function clearVpUsersPlanss()
    {
        $this->collVpUsersPlanss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVpUsersPlanss collection loaded partially.
     */
    public function resetPartialVpUsersPlanss($v = true)
    {
        $this->collVpUsersPlanssPartial = $v;
    }

    /**
     * Initializes the collVpUsersPlanss collection.
     *
     * By default this just sets the collVpUsersPlanss collection to an empty array (like clearcollVpUsersPlanss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVpUsersPlanss($overrideExisting = true)
    {
        if (null !== $this->collVpUsersPlanss && !$overrideExisting) {
            return;
        }

        $collectionClassName = VpUsersPlansTableMap::getTableMap()->getCollectionClassName();

        $this->collVpUsersPlanss = new $collectionClassName;
        $this->collVpUsersPlanss->setModel('\App\Models\VpUsersPlans');
    }

    /**
     * Gets an array of ChildVpUsersPlans objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVpPlans is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVpUsersPlans[] List of ChildVpUsersPlans objects
     * @throws PropelException
     */
    public function getVpUsersPlanss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVpUsersPlanssPartial && !$this->isNew();
        if (null === $this->collVpUsersPlanss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVpUsersPlanss) {
                // return empty collection
                $this->initVpUsersPlanss();
            } else {
                $collVpUsersPlanss = ChildVpUsersPlansQuery::create(null, $criteria)
                    ->filterByVpPlans($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVpUsersPlanssPartial && count($collVpUsersPlanss)) {
                        $this->initVpUsersPlanss(false);

                        foreach ($collVpUsersPlanss as $obj) {
                            if (false == $this->collVpUsersPlanss->contains($obj)) {
                                $this->collVpUsersPlanss->append($obj);
                            }
                        }

                        $this->collVpUsersPlanssPartial = true;
                    }

                    return $collVpUsersPlanss;
                }

                if ($partial && $this->collVpUsersPlanss) {
                    foreach ($this->collVpUsersPlanss as $obj) {
                        if ($obj->isNew()) {
                            $collVpUsersPlanss[] = $obj;
                        }
                    }
                }

                $this->collVpUsersPlanss = $collVpUsersPlanss;
                $this->collVpUsersPlanssPartial = false;
            }
        }

        return $this->collVpUsersPlanss;
    }

    /**
     * Sets a collection of ChildVpUsersPlans objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $vpUsersPlanss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildVpPlans The current object (for fluent API support)
     */
    public function setVpUsersPlanss(Collection $vpUsersPlanss, ConnectionInterface $con = null)
    {
        /** @var ChildVpUsersPlans[] $vpUsersPlanssToDelete */
        $vpUsersPlanssToDelete = $this->getVpUsersPlanss(new Criteria(), $con)->diff($vpUsersPlanss);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->vpUsersPlanssScheduledForDeletion = clone $vpUsersPlanssToDelete;

        foreach ($vpUsersPlanssToDelete as $vpUsersPlansRemoved) {
            $vpUsersPlansRemoved->setVpPlans(null);
        }

        $this->collVpUsersPlanss = null;
        foreach ($vpUsersPlanss as $vpUsersPlans) {
            $this->addVpUsersPlans($vpUsersPlans);
        }

        $this->collVpUsersPlanss = $vpUsersPlanss;
        $this->collVpUsersPlanssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related VpUsersPlans objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related VpUsersPlans objects.
     * @throws PropelException
     */
    public function countVpUsersPlanss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVpUsersPlanssPartial && !$this->isNew();
        if (null === $this->collVpUsersPlanss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVpUsersPlanss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVpUsersPlanss());
            }

            $query = ChildVpUsersPlansQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVpPlans($this)
                ->count($con);
        }

        return count($this->collVpUsersPlanss);
    }

    /**
     * Method called to associate a ChildVpUsersPlans object to this object
     * through the ChildVpUsersPlans foreign key attribute.
     *
     * @param  ChildVpUsersPlans $l ChildVpUsersPlans
     * @return $this|\App\Models\VpPlans The current object (for fluent API support)
     */
    public function addVpUsersPlans(ChildVpUsersPlans $l)
    {
        if ($this->collVpUsersPlanss === null) {
            $this->initVpUsersPlanss();
            $this->collVpUsersPlanssPartial = true;
        }

        if (!$this->collVpUsersPlanss->contains($l)) {
            $this->doAddVpUsersPlans($l);

            if ($this->vpUsersPlanssScheduledForDeletion and $this->vpUsersPlanssScheduledForDeletion->contains($l)) {
                $this->vpUsersPlanssScheduledForDeletion->remove($this->vpUsersPlanssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVpUsersPlans $vpUsersPlans The ChildVpUsersPlans object to add.
     */
    protected function doAddVpUsersPlans(ChildVpUsersPlans $vpUsersPlans)
    {
        $this->collVpUsersPlanss[]= $vpUsersPlans;
        $vpUsersPlans->setVpPlans($this);
    }

    /**
     * @param  ChildVpUsersPlans $vpUsersPlans The ChildVpUsersPlans object to remove.
     * @return $this|ChildVpPlans The current object (for fluent API support)
     */
    public function removeVpUsersPlans(ChildVpUsersPlans $vpUsersPlans)
    {
        if ($this->getVpUsersPlanss()->contains($vpUsersPlans)) {
            $pos = $this->collVpUsersPlanss->search($vpUsersPlans);
            $this->collVpUsersPlanss->remove($pos);
            if (null === $this->vpUsersPlanssScheduledForDeletion) {
                $this->vpUsersPlanssScheduledForDeletion = clone $this->collVpUsersPlanss;
                $this->vpUsersPlanssScheduledForDeletion->clear();
            }
            $this->vpUsersPlanssScheduledForDeletion[]= clone $vpUsersPlans;
            $vpUsersPlans->setVpPlans(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this VpPlans is new, it will return
     * an empty collection; or if this VpPlans has previously
     * been saved, it will retrieve related VpUsersPlanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in VpPlans.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVpUsersPlans[] List of ChildVpUsersPlans objects
     */
    public function getVpUsersPlanssJoinVpUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVpUsersPlansQuery::create(null, $criteria);
        $query->joinWith('VpUsers', $joinBehavior);

        return $this->getVpUsersPlanss($query, $con);
    }

    /**
     * Clears out the collVpUserss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVpUserss()
     */
    public function clearVpUserss()
    {
        $this->collVpUserss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collVpUserss crossRef collection.
     *
     * By default this just sets the collVpUserss collection to an empty collection (like clearVpUserss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initVpUserss()
    {
        $collectionClassName = VpUsersPlansTableMap::getTableMap()->getCollectionClassName();

        $this->collVpUserss = new $collectionClassName;
        $this->collVpUserssPartial = true;
        $this->collVpUserss->setModel('\App\Models\VpUsers');
    }

    /**
     * Checks if the collVpUserss collection is loaded.
     *
     * @return bool
     */
    public function isVpUserssLoaded()
    {
        return null !== $this->collVpUserss;
    }

    /**
     * Gets a collection of ChildVpUsers objects related by a many-to-many relationship
     * to the current object by way of the vp_users_plans cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVpPlans is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildVpUsers[] List of ChildVpUsers objects
     */
    public function getVpUserss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVpUserssPartial && !$this->isNew();
        if (null === $this->collVpUserss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collVpUserss) {
                    $this->initVpUserss();
                }
            } else {

                $query = ChildVpUsersQuery::create(null, $criteria)
                    ->filterByVpPlans($this);
                $collVpUserss = $query->find($con);
                if (null !== $criteria) {
                    return $collVpUserss;
                }

                if ($partial && $this->collVpUserss) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collVpUserss as $obj) {
                        if (!$collVpUserss->contains($obj)) {
                            $collVpUserss[] = $obj;
                        }
                    }
                }

                $this->collVpUserss = $collVpUserss;
                $this->collVpUserssPartial = false;
            }
        }

        return $this->collVpUserss;
    }

    /**
     * Sets a collection of VpUsers objects related by a many-to-many relationship
     * to the current object by way of the vp_users_plans cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $vpUserss A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildVpPlans The current object (for fluent API support)
     */
    public function setVpUserss(Collection $vpUserss, ConnectionInterface $con = null)
    {
        $this->clearVpUserss();
        $currentVpUserss = $this->getVpUserss();

        $vpUserssScheduledForDeletion = $currentVpUserss->diff($vpUserss);

        foreach ($vpUserssScheduledForDeletion as $toDelete) {
            $this->removeVpUsers($toDelete);
        }

        foreach ($vpUserss as $vpUsers) {
            if (!$currentVpUserss->contains($vpUsers)) {
                $this->doAddVpUsers($vpUsers);
            }
        }

        $this->collVpUserssPartial = false;
        $this->collVpUserss = $vpUserss;

        return $this;
    }

    /**
     * Gets the number of VpUsers objects related by a many-to-many relationship
     * to the current object by way of the vp_users_plans cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related VpUsers objects
     */
    public function countVpUserss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVpUserssPartial && !$this->isNew();
        if (null === $this->collVpUserss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVpUserss) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getVpUserss());
                }

                $query = ChildVpUsersQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByVpPlans($this)
                    ->count($con);
            }
        } else {
            return count($this->collVpUserss);
        }
    }

    /**
     * Associate a ChildVpUsers to this object
     * through the vp_users_plans cross reference table.
     *
     * @param ChildVpUsers $vpUsers
     * @return ChildVpPlans The current object (for fluent API support)
     */
    public function addVpUsers(ChildVpUsers $vpUsers)
    {
        if ($this->collVpUserss === null) {
            $this->initVpUserss();
        }

        if (!$this->getVpUserss()->contains($vpUsers)) {
            // only add it if the **same** object is not already associated
            $this->collVpUserss->push($vpUsers);
            $this->doAddVpUsers($vpUsers);
        }

        return $this;
    }

    /**
     *
     * @param ChildVpUsers $vpUsers
     */
    protected function doAddVpUsers(ChildVpUsers $vpUsers)
    {
        $vpUsersPlans = new ChildVpUsersPlans();

        $vpUsersPlans->setVpUsers($vpUsers);

        $vpUsersPlans->setVpPlans($this);

        $this->addVpUsersPlans($vpUsersPlans);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$vpUsers->isVpPlanssLoaded()) {
            $vpUsers->initVpPlanss();
            $vpUsers->getVpPlanss()->push($this);
        } elseif (!$vpUsers->getVpPlanss()->contains($this)) {
            $vpUsers->getVpPlanss()->push($this);
        }

    }

    /**
     * Remove vpUsers of this object
     * through the vp_users_plans cross reference table.
     *
     * @param ChildVpUsers $vpUsers
     * @return ChildVpPlans The current object (for fluent API support)
     */
    public function removeVpUsers(ChildVpUsers $vpUsers)
    {
        if ($this->getVpUserss()->contains($vpUsers)) {
            $vpUsersPlans = new ChildVpUsersPlans();
            $vpUsersPlans->setVpUsers($vpUsers);
            if ($vpUsers->isVpPlanssLoaded()) {
                //remove the back reference if available
                $vpUsers->getVpPlanss()->removeObject($this);
            }

            $vpUsersPlans->setVpPlans($this);
            $this->removeVpUsersPlans(clone $vpUsersPlans);
            $vpUsersPlans->clear();

            $this->collVpUserss->remove($this->collVpUserss->search($vpUsers));

            if (null === $this->vpUserssScheduledForDeletion) {
                $this->vpUserssScheduledForDeletion = clone $this->collVpUserss;
                $this->vpUserssScheduledForDeletion->clear();
            }

            $this->vpUserssScheduledForDeletion->push($vpUsers);
        }


        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->title = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collVpDayss) {
                foreach ($this->collVpDayss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVpUsersPlanss) {
                foreach ($this->collVpUsersPlanss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVpUserss) {
                foreach ($this->collVpUserss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collVpDayss = null;
        $this->collVpUsersPlanss = null;
        $this->collVpUserss = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(VpPlansTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
